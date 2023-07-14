<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\School;
use Modules\School\Entities\SchoolPlants;
use Modules\Plants\Entities\Plants;
use Modules\School\Entities\SchoolPlantFilters;
use Modules\Filters\Entities\Filters;
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
        return view('school::show',compact('school'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($id)
    {
        $school=School::find($id);
        return view('school::profile',compact('school'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

     public function addplant(Request $req, $id)
    {
        $req->validate([
            'plant_id'=>'required',
            'vendor_id'=>'required',
            'estimated_cost'=>'required'
        ]);

        DB::beginTransaction();
        try{

        $plant=Plants::find($req->plant_id);
        $filters=$plant->filters;
    
        if($filters->count()<1){
             return redirect('school/show/'.$id)->with('warning','Plant have no filter');
        }

        $sp=SchoolPlants::create([
            'school_id'=>$id,
            'plant_id'=>$req->plant_id,
            'vendor_id'=>$req->vendor_id,
            'estimated_cost'=>$req->estimated_cost,
            'status'=>0
        ]);

        foreach($filters as $filter){

            $changed_date=now()->format('Y-m-d');

            $next_change_date=CalculateNextChangeDate($changed_date, $filter->filter_change_frequency);

            $spf=SchoolPlantFilters::create([
                'school_plant_id'=>$sp->id,
                'plant_id'=>$sp->school_id,
                'filter_id'=>$filter->id,
                'status'=>1,
                'frequency'=>$filter->filter_change_frequency,
                'last_changed_date'=>$changed_date,
                'next_change_date'=>$next_change_date,
            ]);

        }
        DB::commit();
         return redirect('school/show/'.$id)->with('success','School Plants successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }



    }

    public function editplant($id)
    {
        $res=['success'=>false, 'message'=>null, 'data'=>null];
        try {
            $data=SchoolPlants::find($id);

            $html=view('school::edit-plant')->withData($data)->render();

            $res=['success'=>true, 'message'=>'Water Plant successfully fetched', 'data'=>$html];

            return response()->json($res);

        } catch (Exception $e) {
            $res=['success'=>false, 'message'=>$e->getMessage(), 'data'=>null];
            return response()->json($res);

        } catch (Throwable $e){
            $res=['success'=>false, 'message'=>$e->getMessage(), 'data'=>null];
            return response()->json($res);
        }    
    }


     public function updateplant(Request $req, $id)
    {
        $req->validate([
            'vendor_id'=>'required',
            'estimated_cost'=>'required'
        ]);

        DB::beginTransaction();
        try{
        $sp=SchoolPlants::find($id);
        $school_id=$sp->school_id;

        $inputs=$req->except('_token');
        if($req->status==1){
            $inputs['installation_start_date']=now();
        }
        $sp->update($inputs);
        DB::commit();
         return redirect('school/show/'.$school_id)->with('success','School Plants successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }



    }

    public function changefilter(Request $req, $id)
    {

        $req->validate([
            'date'=>'required',
        ]);

        DB::beginTransaction();
        try{

            $changed_date=$req->date;
            $spf=SchoolPlantFilters::find($id);

            $sp=SchoolPlants::find($spf->school_plant_id);
            $school_id=$sp->school_id;
            $next_change_date=CalculateNextChangeDate($changed_date, $spf->frequency);

            $stock=Stock::where(['school_id'=>$school_id, 'filter_id'=>$spf->filter_id])->where('available_filters', '>=',0)->first();

            if($stock==null){
                 return redirect()->back()->with('warning','this filter is out of stock');
            }



            $spf->update([
                'last_changed_date'=>$changed_date,
                'next_change_date'=>$next_change_date,
            ]);

            $stock->update([
                'used_filters'=>$stock->used_filters+1,
                'available_filters'=>$stock->available_filters-1,
            ]);

        DB::commit();
         return redirect('school/show/'.$school_id)->with('success','Filter successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }

    }


    public function updatestock(Request $req, $id)
    {
        $req->validate([
            'date'=>'required',
            'stock'=>'required',
        ]);

        DB::beginTransaction();
        try{

            $changed_date=$req->date;
            $spf=SchoolPlantFilters::find($id);

            $sp=SchoolPlants::find($spf->school_plant_id);
            $school_id=$sp->school_id;


            $spf->update([
                'total_stock'=>$spf->total_stock+$req->stock,
                'available_stock'=>$spf->available_stock+$req->stock,
                'stock_date'=>$req->date,
            ]);


        DB::commit();
         return redirect('school/show/'.$school_id)->with('success','Stock successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }    
     }



    public function destroyplant($id)
    {
        DB::beginTransaction();
        try{
        $sp=SchoolPlants::find($id);        
        $school_id=$sp->school_id;
        SchoolPlantFilters::where('school_plant_id', $id)->delete();
        $sp->delete();
        DB::commit();
         return redirect('school/show/'.$school_id)->with('success','School Plant removed successfully');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }    
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
