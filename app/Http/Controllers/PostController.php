<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }

    public function updatePost(Request $request, Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        // Strip any HTML tags from the input
        $incommingFields['title'] = strip_tags($incommingFields['title']);
        $incommingFields['body'] = strip_tags($incommingFields['body']);

        $post->update($incommingFields);
        return redirect('/')->with('success', 'Post updated successfully!');
    } 


    
    public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        
        // Strip any HTML tags from the input
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        
        Post::create($incomingFields);
        return redirect('/');
    }
}