<?php

namespace Modules\Plants\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Filters\Entities\Filters;
use Modules\Plants\Entities\Plants;
use Modules\Plants\Entities\PlantsFilter;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $plants=Plants::with('filters')->orderBy('id','ASC')->get();
           return DataTables::of($plants)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('plants.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('plants/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('plants.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('plants/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('filters',function($row){
              $filters='';
              foreach($row->filters as $filter){
                $filters.='<span class="badge bg-info m-1 p-1">'.$filter->name.'</span>';
              }
              return $filters;

           })
           ->rawColumns(['filters','action'])
           ->make(true);
        }
        return view('plants::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $filters=Filters::all();
        return view('plants::create',compact('filters'));
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
            'filters'=>'required',
        ]);
        DB::beginTransaction();
         try{
            $input=$req->except('_token','filters');
            $plant=Plants::create($input);
            foreach($req->filters as $filter) {
                PlantsFilter::create([
                    'plant_id'   =>$plant->id,
                    'filter_id' => $filter
                    ]);
            }
            DB::commit();
            return redirect('plants')->with('success','Plants sccessfully created');
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
        return view('plants::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       /*$plants=(DB::table('plant_filters')->where('plant_id',$id)->get());*/
        return view('plants::edit'/*,compact('plants')*/);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        



         /*   $plant_filter = PlantsFilter::findOrFail($id);
            $plant = Plants::where('name', $plant_filter->plant_id)->get();
            foreach ($plant as $plants) {
                DB::table('plants')->where('name', $plants->id)->delete();
            }
            PlantsFilter::where('plant_filters', $plant_filter->plant_id)->delete();
            }
*/



}

}
