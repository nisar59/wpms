<?php

namespace Modules\WaterQualityTest\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WaterQualityTest\Entities\WaterQualityTest;
use Modules\School\Entities\School;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class WaterQualityTestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
            $wqt=WaterQualityTest::orderBy('id','ASC')->get();
            
               return DataTables::of($wqt)

               ->addColumn('action',function ($row){
                   $action='';
                   if(Auth::user()->can('water-quality-test.edit')){
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('water-quality-test/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Auth::user()->can('water-quality-test.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('water-quality-test/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               }
                   return $action;
               })

               ->editColumn('school_id',function($row)
               {
                   return School($row->school_id);
               })
               ->editColumn('sample_collected_date',function($row)
               {
                   return $row->sample_collected_date;
               })
               ->editColumn('test_completed_date',function($row)
               {
                   return $row->test_completed_date;
               })

                ->editColumn('results',function($row)
               {
                    if($row->test_completed_date==null){
                        return;
                    }
                    $res='';
                   $results=$row->results!=null ? json_decode($row->results) : [];
                    foreach ($results as $key => $vl) {
                        $res.="<span><b>".ucfirst($key).": </b>".$vl."</span><br>";
                    }

                    return $res;
               })

               ->rawColumns(['action', 'results'])
               ->make(true);
        }




        return view('waterqualitytest::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $schools=School::all();
        return view('waterqualitytest::create')->with(['schools'=>$schools]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req, $id)
    {
        $req->validate([
            'sample_collected_date'=>'required'
        ]);

        DB::beginTransaction();
         try{
            $inputs=$req->except('_token');
            $inputs['school_id']=$id;
            $inputs['status']=1;
            WaterQualityTest::create($inputs);
            DB::commit();
            return redirect()->back()->with('success','Water Quality Test successfully updated');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }    
    }


    public function createstore(Request $req)
    {
        $req->validate([
            'school_id'=>'required',
            'sample_collected_date'=>'required',
        ]);

        DB::beginTransaction();
         try{
            $inputs=$req->except('_token');
            $inputs['status']=1;
            if($req->sample_collected_date!=null){
            $inputs['status']=2;
            $inputs['results']=json_encode($req->results);
            }

            WaterQualityTest::create($inputs);
            DB::commit();
            return redirect('water-quality-test')->with('success','Water Quality Test successfully updated');
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
        return view('waterqualitytest::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id)
    {
        $schools=School::all();
        $wqt=WaterQualityTest::find($id);
        return view('waterqualitytest::edit')->with(['schools'=>$schools, 'wqt'=>$wqt]);

    }

    public function editmodal($id)
    {
        $res=['success'=>false, 'message'=>null, 'data'=>null];
        try {
            $data=WaterQualityTest::find($id);

            $html=view('waterqualitytest::edit-modal')->withData($data)->render();

            $res=['success'=>true, 'message'=>'Water Quality Test successfully fetched', 'data'=>$html];

            return response()->json($res);

        } catch (Exception $e) {
            $res=['success'=>false, 'message'=>$e->getMessage(), 'data'=>null];
            return response()->json($res);

        } catch (Throwable $e){
            $res=['success'=>false, 'message'=>$e->getMessage(), 'data'=>null];
            return response()->json($res);
        }

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
            'test_completed_date'=>'required'
        ]);

        DB::beginTransaction();
         try{
            $inputs=$req->except('_token','results');
            $inputs['results']=json_encode($req->results);
            $inputs['status']=2;
            WaterQualityTest::find($id)->update($inputs);
            DB::commit();
            return redirect()->back()->with('success','Water Quality Test successfully updated');
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
            WaterQualityTest::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success','Water Quality Test successfully deleted');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        } 
    }
}
