<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Filters\Entities\Filters;
use Modules\School\Entities\School;
use Modules\Stock\Entities\Stock;
use Modules\School\Entities\SchoolPlants;
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

           ->editColumn('filter_id',function ($row){
              return Filter($row->filter_id);
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
        $schools=School::all();
        return view('stock::create',compact('schools'));
    }

    public function filters($id)
    {
         try{
            $sps=SchoolPlants::where('school_id', $id)->get();
            $filters='<option value="">Select Filter</option>';

            foreach($sps as $sp){
                foreach($sp->SPF as $spf){
                    $filter_detail=FilterDetail($spf->filter_id);
                    if($filter_detail!=null){
                        $filters.='<option value="'.$filter_detail->id.'">'.$filter_detail->name.'</option>';
                    }

                }
            }

         return response()->json(['success'=>true,'data'=>$filters,'message'=>'Filters sccessfully fetched']);

         }catch(Exception $ex){
         return response()->json(['success'=>false,'data'=>null,'message'=>'Something went wrong with this error: '.$ex->getMessage()]);
        }catch(Throwable $ex){
         return response()->json(['success'=>false,'data'=>null,'message'=>'Something went wrong with this error: '.$ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'school'=>'required',
            'filter'=>'required',
            'no_of_filter'=>'required',
            'received_date'=>'required',
        ]);
        DB::beginTransaction();
         try{
            Stock::create([
                'school_id'=>$req->school,
                'filter_id'=>$req->filter,
                'no_of_filter'=>$req->no_of_filter,
                'used_filters'=>0,
                'available_filters'=>$req->no_of_filter,
                'received_date'=>$req->received_date,
            ]);
            DB::commit();
            return redirect('stock')->with('success','Stock sccessfully added');
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
        $schools=School::all();
        return view('stock::edit',compact('stock','schools'));
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
            'school'=>'required',
            'filter'=>'required',
            'no_of_filter'=>'required',
            'received_date'=>'required',
        ]);
        DB::beginTransaction();
         try{
            $stock=Stock::find($id);

            $stock->update([
                'school_id'=>$req->school,
                'filter_id'=>$req->filter,
                'no_of_filter'=>$req->no_of_filter,
                'received_date'=>$req->received_date,
            ]);
            DB::commit();
            return redirect('stock')->with('success','Stock sccessfully updated');
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
         return redirect('stock')->with('success','Stock successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
