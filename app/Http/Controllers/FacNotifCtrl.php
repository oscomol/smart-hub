<?php

namespace App\Http\Controllers;

use App\Models\FacNotif;
use Illuminate\Http\Request;

class FacNotifCtrl extends Controller
{
    public function index(){
        $notifs = FacNotif::all();

        return view('faculty.notification', compact('notifs'));
    }
}
