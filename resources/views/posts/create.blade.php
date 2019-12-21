@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">        
            <div class="col-8 offset-2">
                <h2>New Post</h2>
                 <div class="form-group row">
                     <label for="caption" class="col-md-4 col-form-label">{{ __('Post caption') }}</label>    
                     <input
                         id="caption"
                         type="text" 
                         class="form-control @error('caption') is-invalid @enderror" 
                         name="caption" 
                         value="{{ old('caption') }}"
                         required autocomplete="caption"
                     >
         
                     @error('caption')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>

                 <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                        <strong>{{ $message }}</strong>
                     @enderror
                 </div>

                 <div class="row">
                     <button class="btn btn-primary mt-4">Add New Post</button>
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection
