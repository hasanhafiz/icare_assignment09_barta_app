<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }
    
    public function registerPost(Request $request) {

        $validated = $request->validate([
            'fullname' => ['required', 'min:3', 'max:100'],
            'username' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:12'],
        ]);
        
        // dd( $request );
        // $user = new User;
        // $user->fullname = $request->fullname;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // $user->password = Hash::make( $request->password );

        // $user->save();

        if ( User::create($validated) ) {
            return redirect()->route('login')->with('status', 'User is Registered Successfully.');
        }
        return back()->with('success', 'Registered successfully!');
    }

    public function login() {
        return view('login');
    }
    
    public function loginPost(Request $request) {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if ( Auth::attempt( $credentials ) ) {
            return redirect('/home')->with('success', 'Logged in successfull!');
        }
        
        return back()->with('error', 'Email or Password is wrong!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
    
    
    
}
