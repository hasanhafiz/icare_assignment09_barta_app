<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
        return view('profiles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find( $id );
        return view('profiles.edit', $user);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'min:3', 'max:50'],
            'lastname' => ['required', 'min:3', 'max:50'],
            'bio' => ['required', 'min:10', 'max:500'],
            'email' => ['required', 'email'],
            'profile_picture' => ['required', 'mimes:jpg,png', 'max:1024']
        ]);
        
        // If no errors occured, save user profile data.
        $user = User::find( $id );
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->bio = $request->bio;
        
        $file = $request->file('profile_picture');
        if ( isset( $file ) ) {
            
            // if same file exists, delete it first
            // Storage::delete('file.jpg');            
            
            $file_extension = $file->extension();
            $file_name = auth()->user()->id . '.' . $file_extension;
            
            if ( Storage::exists( 'storage/avatars/' . $file_name ) ) {
                // dd ('exists');
                Storage::delete('storage/avatars/' . $file_name );  
                
                // dd( $user ); 
            }            
            
            $user->profile_picture = $request->file('profile_picture')->storePubliclyAs('storage/avatars', $file_name );                
        }
        
        
       // $user->password = Hash::make( $request->password );
        $user->save();
        return redirect()->route('profiles.index')->with('status', 'User profile updated Successfully.');
        
        // dump( $user );
        // dd( $request );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
