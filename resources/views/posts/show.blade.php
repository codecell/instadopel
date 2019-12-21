@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div>
                    <img src="{{ $post->user->profile->profileImage() }}" class="w-100 rounded-circle mr-3" style="max-width:40px">
                </div>
                <div>
                    <span>
                        <a href="/profile/{{$post->user->id }}" class="font-weight-bold text-dark">{{ $post->user->username}}</a>
                    </span>

                    <span class="m-2 text-muted">|</span>

                    <span>
                        <a href="#">Follow</a>
                    </span>
                </div>
            </div>

            <hr>

            <p>
                <span><a href="/profile/{{$post->user->id }}" class="font-weight-bold text-dark mr-2">{{ $post->user->username}}</a></span>
                <span>{{ $post->caption }}</span>
            </p>
        </div>
    </div>
</div>
@endsection
