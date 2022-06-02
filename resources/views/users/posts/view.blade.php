@extends('layout')
@section('content')

<div class="container">

  <a class="nav-link" href="{{ route('user.create-post.GET') }}">Create Post</a>
  <h2>All My Posts</h2>
  @isset($posts)
    
  <table class="table table-bordered">
    <thead>
      <tr style="background-color:white">
        <th>name</th>
        <th>details</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)  
      <tr style="background-color:white">
        <td>{{$post->name}}</td>
        <td>{{$post->details}}</td>
        <td><a href="{{ route('user.edit-post.GET',$post->id) }}" class="link-success">Edit Post</a></td>
      </tr>
      @endforeach

    </tbody>
  </table>
  @endisset
  @isset($error)
    <div class="alert alert-danger">
    {{$error}}
    </div>
@endisset
</div>
@endsection