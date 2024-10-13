<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts_count = Post::where('user_id', auth()->id() )->count();
        return view('profiles.index', ['posts_count' => $posts_count]);
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
        
        // dd( $user );
        
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
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:1024']
        ]);
        
        // If no errors occured, save user profile data.
        $user = User::find( $id );
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->bio = $request->bio;
        
        if ( $user->password ) {
            $user->password = Hash::make( $request->password );
        }
        
        $file = $request->file('profile_picture');
        if ( isset( $file ) ) {
            
            // if same file exists, delete it first
            // Storage::delete('file.jpg');            
            
            $file_extension = $file->extension();
            $file_name = 'img_'. auth()->user()->id . '.' . $file_extension;
            
            // if ( Storage::exists( 'public' . $file_name ) ) {
                // dd ('exists');
                // Storage::delete('storage/avatars/' . $file_name );  
                Storage::disk('public')->delete( $file_name );
                
                // dd( $user ); 
            // }
            // $path = $request->file('profile_picture')->storeAs('avatars', $file_name, 'public'  ); // same as without 3rd params
            $path = $request->file('profile_picture')->storeAs('avatars', $file_name  );
            
            // dd( $path );
            $user->profile_picture = $path;                 
        }
        
        // dd ($user);
        
        $user->save();
        return redirect()->route('profiles.index')->with('status', 'User profile updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
