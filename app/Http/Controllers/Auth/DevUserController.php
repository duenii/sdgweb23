<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DevUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevUserController extends Controller
{
    
    public function index()
    {
        if(Auth::id()){
            
            $role=Auth()->user()->role;

            if($role=='user'){
                return view('agent.dashboard');
            }
            elseif($role=='dev'){
                
               // $adminweb = User::all();
                return view('admin.dashboard');

            }

        }
        
       
        //return $Banners;
        
    }

    // public function dev()
    // {
    //    return view('admin.dasboard');
    // }

    // public function agent()
    // {
    //    return view('agent.dasboard');
    // }
      
           
}
        
       
        //return $Banners;

