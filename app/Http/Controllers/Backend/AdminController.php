<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminLogout()
    {
        Auth::logout();
        $notification = [
            'message' => 'Admin logout Successfully',
            'alert-type' => 'success'
        ];
        return redirect('/login')->with($notification);
    }
}
