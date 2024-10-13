<?php
namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogController extends Controller
{
    public function logs()
    {
        $logs = UserLog::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.logs', ['logs' => $logs]);
    }
}

