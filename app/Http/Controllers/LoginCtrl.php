<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginCtrl extends Controller
{
    public function index(Request $request){
        $userType = $request->userType;
        
        return view('auth.login', compact('userType'));
    }

    public function login(Request $request)
    {
        $userType = $request->userType;
    
        if ($request->isMethod('post')) {
            if ($userType === "administrator" || $userType === "faculty") {
               
                $credentials = [
                    'username' => $request->username,
                    'password' => $request->password,
                ];
    
                if (Auth::attempt($credentials)) {
                    if($userType === "administrator"){
                        return redirect('/admin');
                    }
                    return redirect('/faculty');
                } else {
                    return back()->with('error', true);
                }
            }
            else if ($userType === "student" || $userType === "parents") {
                $credentials = [
                    'lrn' => $request->lrn,
                    'userType' => $userType,
                    'password' => 'student',
                ];
    
                if (Auth::attempt($credentials)) {
                    if($userType === "student"){
                        return redirect('/student');
                    }
                    return redirect('/parents');
                } else {
                    return back()->with('error', true);
                }
            }
        }
    
        return view('auth.login', compact('userType'));
    }

    public function sampleInsertUser(){
        User::create([
            "lrn" => 7161,
            "password" => Hash::make('student'),
            "userType" => "parents"
        ]);
    }
     
}
