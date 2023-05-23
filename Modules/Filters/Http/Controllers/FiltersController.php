<?php

namespace Modules\Filters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Filters\Entities\Filters;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class FiltersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
          if (request()->ajax()) {
        $filters=Filters::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($filters)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('filters.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('filters/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('filters.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('filters/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('filters::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('filters::create');
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
            'filter_change_frequency'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Filters::create($req->except('_token'));
            DB::commit();
            return redirect('filters')->with('success','Filter sccessfully created');
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
        return view('filters::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $filters=Filters::find($id);
        return view('filters::edit',compact('filters'));
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
            'filter_change_frequency'=>'required',
        ]);
        DB::beginTransaction();
         try{
             Filters::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('filters')->with('success','Filter sccessfully Updated');
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
        Filters::find($id)->delete();
        DB::commit();
         return redirect('filters')->with('success','Filter successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
