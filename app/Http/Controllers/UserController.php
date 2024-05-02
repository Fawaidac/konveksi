<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::OrderByDesc('id')->get();
        return view('dashboard.user', compact('user'));
    }
}
