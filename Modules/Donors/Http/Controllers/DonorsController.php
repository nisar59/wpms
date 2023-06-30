<?php

namespace Modules\Donors\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Donors\Entities\Donors;
use Modules\Country\Entities\Country;
use Modules\State\Entities\State;
use Modules\Districts\Entities\Districts;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class DonorsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
          if (request()->ajax()) {
        $donors=Donors::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($donors)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('donors.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('donors/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('donors.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('donors/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })->editColumn('country',function ($row)
           {
             return Country($row->country);
           })
           ->editColumn('state',function ($row)
           {
             return State($row->state);
           })
           ->editColumn('district',function ($row)
           {
             return Districts($row->district);
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('donors::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      $country=Country::all();
        return view('donors::create',compact('country'));
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
     public function fetchState(Request $req)
    {
        $data['states'] = State::where("country_id", $req->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

     public function fetchCity(Request $req)
    {
        $data['cities'] = Districts::where("state_id", $req->state_id)->get(["name", "id"]);
                                      
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
           $req->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'state'=>'required',
            'district'=>'required',
            'address'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Donors::create($req->except('_token'));
            DB::commit();
            return redirect('donors')->with('success','Donors sccessfully created');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('donors::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $country=Country::all();
        $state=State::all();
        $district=Districts::all();
        $donors=Donors::find($id);
        return view('donors::edit',compact('country','state','district','donors'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'state'=>'required',
            'district'=>'required',
            'address'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Donors::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('donors')->with('success','Donors sccessfully Updated');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());


        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
         DB::beginTransaction();
        try{
        Donors::find($id)->delete();
        DB::commit();
         return redirect('donors')->with('success','Donors successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
