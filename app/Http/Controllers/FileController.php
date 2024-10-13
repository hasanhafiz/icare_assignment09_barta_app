<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function fileupload() {
        return view('profiles.fileupload');
    }    
    
    public function store(Request $request) {
        
        $file = $request->file('upload_file');
        
        $files['name'] = $file->getClientOriginalName();
        $files['basename'] = File::name($files['name'] );
        $files['extension'] = $file->getClientOriginalExtension();  // same as  $file->extension();
        $files['unique_name'] = $file->hashName(); // Generate a unique, random name...
        $files['extension2'] = $file->extension(); // Determine the file's extension based on the file's MIME type...        
        
        // dd( $files );        
        // dd( $request->file('upload_file') );    
        
        // $request->file('upload_file')->storeAs('avatars', $files['name'] . time() . '.'. $files['extension'] );
        $path = $request->file('upload_file')->storePubliclyAs('public/avatars', $files['basename'] . time() . '.'. $files['extension'] );
        
        dd($path);
    }
}