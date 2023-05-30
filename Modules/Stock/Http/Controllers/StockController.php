<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Filters\Entities\Filters;
use Modules\Venders\Entities\Venders;
use Modules\School\Entities\School;
use Modules\Stock\Entities\Stock;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
use Carbon\Carbon;
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
            if (request()->ajax()) {
            $stock=Stock::select('*')->orderBy('id','ASC')->get();
            return DataTables::of($stock)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('stock.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('stock/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('stock.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('stock/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->editColumn('received_date',function ($row){
               return Carbon::parse($row->received_date)->format('d-m-Y');
           })
           ->editColumn('vender',function ($row){
              return Venders($row->vender);
           })
           ->editColumn('filter',function ($row){
              return Filter($row->filter);
           })
           ->editColumn('school_id',function ($row){
              return School($row->school_id);
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('stock::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $filters=Filters::all();
        $venders=Venders::all();
        $schools=School::all();
        return view('stock::create',compact('filters','venders','schools'));
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
            'costodian_number'=>'required',
            'relation'=>'required',
            'no_of_filter'=>'required',
            'received_date'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Stock::create($req->except('_token'));
            DB::commit();
            return redirect('school')->with('success','Stock Management sccessfully created');
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
        return view('stock::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $stock=Stock::find($id);
        $filters=Filters::all();
        $venders=Venders::all();
        $schools=School::all();
        return view('stock::edit',compact('stock','filters','venders','schools'));
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
            'costodian_number'=>'required',
            'relation'=>'required',
            'no_of_filter'=>'required',
            'received_date'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Stock::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('stock')->with('success','Stock Management sccessfully Updated');
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
        Stock::find($id)->delete();
        DB::commit();
         return redirect('stock')->with('success','Stock Managementuccessfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
