@extends('layout')
@section('content')
<div class="container">
    @if(session()->has('success') )
    <div class="alert alert-success">
    {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('error'))  
    <div class="alert alert-danger">
    {{ session()->get('error')}}
    </div>
    @endif
  <h2>Create Post</h2>
  <form action="{{ route('user.create-post.POST') }}" method="POST">
   @csrf

    <div class="form-group">
      <label for="email">name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter post name" name="name"  value="{{ old('name') }}">
      @if ($errors->has('name'))

      <span class="text-danger">{{ $errors->first('name') }}</span>

      @endif
    </div>
    <div class="form-group">
      <label for="pwd">details:</label>
      <input type="text" class="form-control" id="details" placeholder="Enter post details" name="details"  value="{{ old('details') }}">
      @if ($errors->has('details'))

      <span class="text-danger">{{ $errors->first('details') }}</span>

      @endif
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection