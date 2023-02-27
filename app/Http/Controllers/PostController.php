<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|min:5',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()
                    ]);
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json(['success'=>true]);
    }
}
