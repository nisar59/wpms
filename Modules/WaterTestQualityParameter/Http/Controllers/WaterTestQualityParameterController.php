<?php

namespace Modules\WaterTestQualityParameter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WaterTestQualityParameter\Entities\WaterTestQualityParameter;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class WaterTestQualityParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
          if (request()->ajax()) {
        $water=WaterTestQualityParameter::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($water)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('water-test-quality-parameter.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('water-quality-test-parameters/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('water-test-quality-parameter.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('water-quality-test-parameters/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('watertestqualityparameter::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('watertestqualityparameter::create');
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
        ]);
        DB::beginTransaction();
         try{
            WaterTestQualityParameter::create($req->except('_token'));
            DB::commit();
            return redirect('water-quality-test-parameters')->with('success','Water Quality Test Parameters sccessfully created');
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
        return view('watertestqualityparameter::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $watertest=WaterTestQualityParameter::find($id);
        return view('watertestqualityparameter::edit',compact('watertest'));
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
        ]);
        DB::beginTransaction();
         try{
            WaterTestQualityParameter::find($id)->update($req->except('_token'));
            DB::commit();
            return redirect('water-quality-test-parameters')->with('success','Water Quality Test Parameters sccessfully Updated');
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
        WaterTestQualityParameter::find($id)->delete();
        DB::commit();
         return redirect('water-quality-test-parameters')->with('success','Water Quality Test Parameters successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
