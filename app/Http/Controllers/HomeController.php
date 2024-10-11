<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index() {
        // Retrieve the currently authenticated user...
        $user = Auth::user();
            // echo $user;
        // Retrieve the currently authenticated user's ID...
        $id = Auth::id();
        // echo $id;

        if (Auth::check()) {
            // The user is logged in...

            // get list of users
            $users = User::all();
            return view('home', compact('users'));
        }


    }
}
