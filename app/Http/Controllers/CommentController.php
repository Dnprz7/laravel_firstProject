<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function save(Request $request)
    {

        $validate = $request->validate([
            'image_id' => ['integer', 'required'],
            'content' => ['string', 'required'],
        ]);

        $user = Auth::user();
        $image_id = $request->image_id;
        $content = $request->input("content");


        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return Redirect::route('image.detail', ['id' => $image_id])->with('status', 'comment-created');

    }
}
