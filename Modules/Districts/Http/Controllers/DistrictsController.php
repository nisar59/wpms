<?php

namespace Modules\Districts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\State\Entities\State;
use Modules\Districts\Entities\Districts;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
          if (request()->ajax()) {
        $districts=Districts::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($districts)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('districts.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('districts/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('districts.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('districts/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
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
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('districts::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $country=Country::all();
        $state=State::all();
        return view('districts::create',compact('country','state'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function fetchState(Request $req)
    {
        $data['states'] = State::where("country_id", $req->country_id)->get(["name", "id"]);
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
            'country_id'=>'required',
            'state_id'=>'required',
            'name'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Districts::create($req->except('_token'));
            DB::commit();
            return redirect('districts')->with('success','Districts sccessfully created');
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

        return view('districts::show');
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
        $districts=Districts::find($id);
        return view('districts::edit',compact('country','state','districts'));
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
            'country_id'=>'required',
            'state_id'=>'required',
            'name'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Districts::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('districts')->with('success','Districts sccessfully Updated');
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
        Districts::find($id)->delete();
        DB::commit();
         return redirect('districts')->with('success','Districts successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
