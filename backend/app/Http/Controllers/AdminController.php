<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createUser(Request $request){
        $admin = new Userdata;
        $admin ->username = $request->input('username');
        $admin ->password = $request->input('password');
        $admin->save();

        return response()->json([
         'status'=>200,
         'message'=> 'success',
        ]);
     }

     public function index(){
        return Userdata::all();
    }
}
