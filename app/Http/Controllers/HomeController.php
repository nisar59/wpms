<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Modules\School\Entities\School;
use Modules\Plants\Entities\Plants;
use Modules\School\Entities\SchoolPlants;
use Carbon\Carbon;
use Artisan;
use Auth;
use Throwable;
use Hash;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        User::find(Auth::id())->update([
            'lock_screen_token'=>Hash::make(Auth::id().now()),
        ]);

        $total_school=School::count();
        $students_benefited=School::sum('no_of_students');
        $plants_installed=School::WhereHas('SchoolPlantsInstalled')->count();
        $plants_in_process=School::WhereHas('SchoolPlantsInProcess')->count();
        $pending_schools=School::whereDoesntHave('SchoolPlants')->count();

        $all_schools=School::with('SchoolPlants')->get();


       ///////////////////////////////////////// Bar Chart of plant installed //////////////////////////////////

        $plants_installed_boys=School::WhereHas('SchoolPlantsInstalled')->where('school_gender', 'boys')->count();
        $plants_installed_girls=School::WhereHas('SchoolPlantsInstalled')->where('school_gender', 'girls')->count();
        $plants_installed_co_edu=School::WhereHas('SchoolPlantsInstalled')->where('school_gender', 'co-education')->count();


        $barchart['labels']=['Boys School', 'Girls School', 'Co School'];
        $barchart['datasets'][0]['type']='bar';
        $barchart['datasets'][0]['label']='Boys School';
        $barchart['datasets'][0]['barThickness']=100;
        $barchart['datasets'][0]['data']=[$plants_installed_boys];
        $barchart['datasets'][0]['backgroundColor']=['darkgreen'];
        $barchart['datasets'][0]['borderColor']=['darkgreen'];
        $barchart['datasets'][0]['borderWidth']=2;



        $barchart['datasets'][1]['type']='bar';
        $barchart['datasets'][1]['label']='Girls School';
        $barchart['datasets'][1]['barThickness']=100;
        $barchart['datasets'][1]['data']=[$plants_installed_girls];
        $barchart['datasets'][1]['backgroundColor']=['darkgreen'];
        $barchart['datasets'][1]['borderColor']=['darkgreen'];
        $barchart['datasets'][1]['borderWidth']=2;


        $barchart['datasets'][2]['type']='bar';
        $barchart['datasets'][2]['label']='Co School';
        $barchart['datasets'][2]['barThickness']=100;
        $barchart['datasets'][2]['data']=[$plants_installed_co_edu];
        $barchart['datasets'][2]['backgroundColor']=['darkgreen'];
        $barchart['datasets'][2]['borderColor']=['darkgreen'];
        $barchart['datasets'][2]['borderWidth']=2;

        $barchart=json_encode($barchart);

/////////////////////////////////////////////// finish plant installed bar chart //////////////////////////////


///////////////////////////////////////////// Pie Chart plant type ///////////////////////////////////////////

        $plants=Plants::all();

        $pie['labels']=[];

        foreach ($plants as $key => $plant) {
           $plant_type_count=SchoolPlants::where('plant_id', $plant->id)->count();
           $pie['labels'][]= $plant_type_count.' '.$plant->name;
           $pie['datasets'][0]['data'][$key]=2;
           $pie['datasets'][0]['backgroundColor'][$key]=ColorsPack()[$key];
           $pie['datasets'][0]['hoverBackgroundColor'][$key]=ColorsPack()[$key];
           $pie['datasets'][0]['hoverBorderColor'][$key]=ColorsPack()[$key];
        }

       $pie=json_encode($pie);
///////////////////////////////////////////// finish Pie Chart plant type ///////////////////////////////////////////



/*////////////////////////////////////////// Schools GIS /////////////////////////////////////////////////////////*/

    $gis=[];

    $ci=0;
    foreach ($all_schools as $key => $school) {

        $lat_log=explode(',', $school->gps_coordinate);
        $color=null;
        if(isset(ColorsPack()[$ci])){
            $color=ColorsPack()[$ci]; 
            $ci++;
        }else{
            $ci=0;
            $color=ColorsPack()[$ci]; 
        }

       $gis[]=[
            'name'=> $school->name,
            'students'=> $school->no_of_students,
            'color'=>$color,
            'url'=>url('school/view/'.$school->id),
            'position'=> [
              'lat'=> isset($lat_log[0]) ? (double)str_replace(' ','',$lat_log[0]) : '',
              'lng'=>isset($lat_log[1]) ? (double)str_replace(' ','',$lat_log[1]) : '',
            ],

       ];
    }

$gis=json_encode($gis);
/*////////////////////////////////////////// End Schools GIS /////////////////////////////////////////////////////////*/


    if(request()->route()->uri=="home"){
        return view('home', compact('total_school','students_benefited','plants_installed','plants_in_process', 'barchart', 'pie', 'pending_schools', 'all_schools', 'gis'));
        }else{
        return view('welcome', compact('total_school','students_benefited','plants_installed','plants_in_process', 'barchart', 'pie', 'pending_schools', 'all_schools', 'gis'));
        }   
    }



    public function checkauth()
    {
       return Auth::check();
    }

    public function lockscreen(Request $req)
    {
        try {
            $user=User::where('lock_screen_token', $req->id)->first();
            if($user==null){
            return redirect('login');
            }
            return view('auth.lock-screen')->withUser($user);    
        } catch (Exception $e) {
            return redirect('login');
        } catch(Throwable $e){
            return redirect('login');
        }

    }



    public function artisan($command)
    {
        DB::beginTransaction();
        try{
            $sett=Settings();
            $sett->logging=0;
            $sett->save();
            Artisan::call($command);
            $res=Artisan::output();
            $sett=Settings();
            $sett->logging=1;
            $sett->save();
            DB::commit(); 
            return redirect()->back()->with('info',$res);
        } catch (Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error '.$e->getMessage());
        }catch (Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error '.$e->getMessage());
        }


    }


}
