<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\School;
use Modules\School\Entities\SchoolPlants;
use Modules\Plants\Entities\Plants;
use Modules\Filters\Entities\Filters;
use Modules\Venders\Entities\Venders;
use Modules\Stock\Entities\Stock;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $school=School::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($school)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('school.edit')){
                $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('school/show/'.$row->id).'"><i class="fa fa-eye"></i></a>';
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('school/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('school.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('school/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('school::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function stock()
    {
       
        $filters=Filters::all();
        $venders=Venders::all();
        $schools=School::all();
        return view('school::stock',compact('filters','venders','schools'));
    }   

        /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('school::create');
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
            'province'=>'required',
            'district'=>'required',
            'tehsil'=>'required',            
            'address'=>'required',
            'emis_code'=>['required', 'max:50', 'unique:school'],
            'name_of_focal_person'=>'required',
            'contact_of_focal_person'=>'required',
            'relation_of_focal_person'=>'required',
            'gps_coordinate'=>'required',
            'school_gender'=>'required',
            'no_of_students'=>'required',
            'no_of_male_teachers'=>'required',
            'no_of_female_teachers'=>'required',
        ]);
         DB::beginTransaction();
         try{
            $path=public_path('img/school/');
            $inputs=$req->except('_token', 'image');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->file('image'), $path);
            }
            School::create($inputs);
            DB::commit();
            return redirect('school')->with('success','School sccessfully added');
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
        $school=School::find($id);
        $plants=Plants::all();
        $sch_plnt=SchoolPlants::all();
        return view('school::show',compact('school','plants','sch_plnt'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

     public function schoolPlant(Request $req)
    {
        $req->validate([
            'plant_id'=>'required',
        ]);
        DB::table('school_plants')->insert([
            'plant_id' => $req->plant_id, 
            'school_id' => $req->school_id,  
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

       /**
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id, $status)
    {
        DB::beginTransaction();
        try{
        $school=SchoolPlants::find($id);
        $school->status=$status;
        $school->save();
        DB::commit();
         return redirect('school/show/'.$school->school_id)->with('success','School Plant status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $school=School::find($id);
        return view('school::edit',compact('school'));
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
            'province'=>'required',
            'district'=>'required',
            'tehsil'=>'required',            
            'address'=>'required',
            'emis_code'=>['required', 'max:50', 'unique:school,emis_code,'.$id],
            'name_of_focal_person'=>'required',
            'contact_of_focal_person'=>'required',
            'relation_of_focal_person'=>'required',
            'gps_coordinate'=>'required',
            'school_gender'=>'required',
            'no_of_students'=>'required',
            'no_of_male_teachers'=>'required',
            'no_of_female_teachers'=>'required',        
        ]);
         DB::beginTransaction();
         try{
            $path=public_path('img/school/');
            $inputs=$req->except('_token', 'image');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->file('image'), $path);
            }
             School::find($id)->update($inputs);
            DB::commit();
            return redirect('school')->with('success','School sccessfully updated');
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
        School::find($id)->delete();
        DB::commit();
         return redirect('school')->with('success','School successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
