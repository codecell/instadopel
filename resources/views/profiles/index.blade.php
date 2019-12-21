@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
        <div class="col-3 profile-image-container">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle mt-4" style="height: 100px">
        </div>
        <div class="col-9 pt-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center mb-2">
                    <strong>
                        <div class="mr-5">{{ $user->username}}</div>
                    </strong>
                    
                <follow-button user-id="{{ $user->id}}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create" class="">Add new post</a>                
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit" class="">Edit Profile</a>                
            @endcan
            

            <div class="d-flex">
                <div class="pr-5">
                    <strong>{{ $postCount }}</strong> <span>posts</span>
                </div>
                <div class="pr-5">
                    <strong> {{ $followersCount }} </strong> <span>followers</span>
                </div>
                <div class="pr-5">
                    <strong> {{ $followingCount }} </strong> <span>following</span>
                </div>
            </div>

            <div class="pt-2">
                <div><strong>{{ $user->profile->title }}</strong></div>
                <div> {{ $user->profile->description }} </div>
                <div><a href="">{{ $user->profile->url }}</a></div>
            </div>
        </div>
   </div>

   <div class="row pt-5">
        @foreach($user->posts as $post)            
            <div class="col-4 mb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image ?? ''}}" class="w-100">
                </a>
            </div>
        @endforeach
   </div>

</div>
@endsection
