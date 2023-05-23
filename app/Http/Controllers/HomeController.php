<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        return view('home');
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
