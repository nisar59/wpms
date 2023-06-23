<?php

namespace Modules\Tehsil\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\State\Entities\State;
use Modules\Districts\Entities\Districts;
use Modules\Tehsil\Entities\Tehsil;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class TehsilController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
          if (request()->ajax()) {
        $tehsil=Tehsil::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($tehsil)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('tehsil.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('tehsil/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('tehsil.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('tehsil/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })->editColumn('country_id',function ($row)
           {
               return Country($row->country_id);
           })
          ->editColumn('state_id',function ($row)
           {
               return State($row->state_id);
           })
          ->editColumn('district_id',function ($row)
           {
               return Districts($row->district_id);
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('tehsil::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $country=Country::all();
        return view('tehsil::create',compact('country'));
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
            'country_id'=>'required',
            'state_id'=>'required',
            'district_id'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Tehsil::create($req->except('_token'));
            DB::commit();
            return redirect('tehsil')->with('success','Tehsil sccessfully created');
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
        return view('tehsil::show');
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

    public function edit($id)
    {
        $country=Country::all();
        $state=State::all();
        $districts=Districts::all();
        $tehsil=Tehsil::find($id);
        return view('tehsil::edit',compact('tehsil','country','state','districts'));
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
            'country_id'=>'required',
            'state_id'=>'required',
            'district_id'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Tehsil::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('tehsil')->with('success','Tehsil sccessfully Updated');
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
        Tehsil::find($id)->delete();
        DB::commit();
         return redirect('tehsil')->with('success','Tehsil successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
