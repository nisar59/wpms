<?php

namespace Modules\Venders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Venders\Entities\Venders;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class VendersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $venders=Venders::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($venders)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('venders.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('venders/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('venders.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('venders/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('venders::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('venders::create');
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
            'province'=>'required',
            'district'=>'required',
            'gps_coordinates'=>'required',
            'shop_or_business_address'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Venders::create($req->except('_token'));
            DB::commit();
            return redirect('venders')->with('success','Vender Management sccessfully created');
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
        return view('venders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $venders=Venders::find($id);
        return view('venders::edit',compact('venders'));
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
            'province'=>'required',
            'district'=>'required',
            'gps_coordinates'=>'required',
            'shop_or_business_address'=>'required',
        ]);
        DB::beginTransaction();
         try{
           Venders::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('venders')->with('success','Vender Management sccessfully Updated');
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
        Venders::find($id)->delete();
        DB::commit();
         return redirect('venders')->with('success','Vender Management  successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
