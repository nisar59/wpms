<?php

namespace Modules\WaterQualityTest\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WaterQualityTest\Entities\WaterQualityTest;
use Throwable;
use DB;

class WaterQualityTestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('waterqualitytest::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('waterqualitytest::create');
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
        $res=['success'=>false, 'message'=>null, 'data'=>null];
        try {
            $data=WaterQualityTest::find($id);

            $html=view('waterqualitytest::edit')->withData($data)->render();

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
        //
    }
}
