<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller {

    /**
     * user profile
     */
    public function index(User $user) {

        $postCount = Cache::remember(
            'count.posts.'. $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
        });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'count.posts.following'.$user->id,
            now()->addSeconds(30), function () use ($user) {
                return $user->following->count();
        });

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    /**
     * link to edit profile form
     */
    public function edit(User $user) {
        //  authorise update policy
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    /**
     * perform the actual patch profile action
     */
    public function update(User $user) {
        //  authorise update policy
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ''
        ]);

        // dd($data);
        if (request('image')) {
            
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
            
            $data = array_merge($data, $imageArray ?? []);
        }

        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }


}
