<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {   
        $users = DB::select('select * from users');
        //pass variable to view
        //Cach 1
        return view('admin.pages.user.list', ['users' => $users]);
    }
}
