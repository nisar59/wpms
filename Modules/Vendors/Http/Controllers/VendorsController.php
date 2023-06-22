<?php

namespace Modules\Vendors\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Vendors\Entities\Vendors;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $vendors=Vendors::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($vendors)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('vendors.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('vendors/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('vendors.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('vendors/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }

        return view('vendors::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('vendors::create');
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
            'shop_or_business_address'=>'required',
            'dealing_in'=>'required'
        ]);
        DB::beginTransaction();
         try{
            Vendors::create($req->except('_token'));
            DB::commit();
            return redirect('vendors')->with('success','Vendor successfully added');
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
        return view('vendors::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $vendor=Vendors::find($id);
        return view('vendors::edit',compact('vendor'));
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
            'shop_or_business_address'=>'required',
            'dealing_in'=>'required'
        ]);
        DB::beginTransaction();
         try{
           Vendors::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('vendors')->with('success','Vendor successfully updated');
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
        Vendors::find($id)->delete();
        DB::commit();
         return redirect('vendors')->with('success','Vender successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
