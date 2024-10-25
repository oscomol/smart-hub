<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginCtrl extends Controller
{
    public function index(Request $request) {
        $userType = $request->userType;
        return view('auth.login', compact('userType'));
    }

    public function login(Request $request) {
        
        $userType = $request->userType;

        if ($request->isMethod('post')) {
            if (in_array($userType, ["administrator", "faculty", "staff"])) {
                $credentials = [
                    'username' => $request->username,
                    'password' => $request->password,
                ];

                if (Auth::attempt($credentials)) {
                    if ($userType === "administrator") {
                        return redirect('/admin');
                    }
                    if ($userType === "faculty") {
                        return redirect('/faculty');
                    }
                    if ($userType === "staff") {
                        return redirect('/staff'); 
                    }
                }
                    return back()->with('error', true);
                
            } elseif (in_array($userType, ["student", "parents"])) {
                $credentials = [
                    'lrn' => $request->lrn,
                    'userType' => $userType,
                    'password' => $request->password,
                ];

                if (Auth::attempt($credentials)) {
                    if ($userType === "student") {
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

    public function sampleInsertUser() {
        User::create([
            "username" => "faculty",
            "password" => Hash::make('faculty'),
            "userType" => "faculty"
        ]);
    }
}
