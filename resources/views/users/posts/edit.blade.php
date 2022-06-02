@extends('layout')
@section('content')

<div class="container">
  <h2>Edit Post</h2>
  <form action="/action_page.php">
    <div class="form-group">
      <label for="email">name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter post name" name="name">
    </div>
    <div class="form-group">
      <label for="pwd">details:</label>
      <input type="text" class="form-control" id="details" placeholder="Enter post details" name="details">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection