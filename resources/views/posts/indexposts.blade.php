@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
    <div class="row">
      <div class="col-6 offset-3">
        <a href="/profile/{{ $post->user->id }}">
          <img src="/storage/{{ $post->image }}" class="w-100">
        </a>
      </div>
    </div>  

    <div class="row">
      <div class="col-6 offset-3 mt-2 mb-3">
          <p>
              <span><a href="/profile/{{$post->user->id }}" class="font-weight-bold text-dark mr-2">{{ $post->user->username}}</a></span>
              <span>{{ $post->caption }}</span>
          </p>
      </div>
     </div>
    @endforeach
</div>
@endsection

