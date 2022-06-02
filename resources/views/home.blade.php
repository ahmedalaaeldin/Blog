@extends('layout')
@section('content')
<main>

@isset($error)
    <div class="alert alert-danger">
    {{$error}}
    </div>
@endisset
@isset($posts)
@foreach ($posts as $post) 
    <a style="color:black;text-decoration: none;" href="{{ route('view.post.home', $post->id) }}">
        <div  class="card" style="margin:5px">
            <div class="card-body">
                <h5 class="card-title">{{$post->name}}</h5>
                <h6 class="card-text">{{$post->details}}</h6>
                <p style="color:gray;">wirtten by {{$post->username}}</p>
            </div>
        </div>
    </a>
  
@endforeach
@endisset
   
   <!-- <div  class="card">
    <div class="card-header">Header</div>
    <div class="card-body">
        <h5 class="card-title">Light card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
   </div> -->
  

</main>
@endsection