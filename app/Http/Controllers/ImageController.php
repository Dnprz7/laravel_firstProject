<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        return view("image.create");
    }

    public function save(Request $request)
    {
        $validate = $request->validate([
            'description' => ['required'],
            'image_path' => ['required', 'mimes:jpg,png,gif'],
        ]);


        $image_path = $request->file("image_path");
        $description = $request->input("description");

        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;

        $image->description = $description;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->save();

        return Redirect::route('dashboard')->with('status', 'post-created');
    }

}
