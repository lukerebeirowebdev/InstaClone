<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function index(\App\Models\User $user)
    {

        return view('profiles.index', compact('user'));
    }

    public function edit(\App\Models\User $user)
    
    {
        $this->authorize('update',$user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '' // TODO: Image validation?
        ]);

        if (request('image'))
        {
        $imagePath = request('image')->store('profile', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        $image->save();
        }

        // TODO: Check if user has permission to edit this profile

        $user->profile->update(array_merge(
            $data, ['image' => $imagePath]
        ));

        return redirect()->route('profile.show', $user->id);
    }
}
