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
   
        <div  class="card" style="margin:5px">
            <div class="card-body">
                <small class="post_id" hidden>{{$post->id}}</small>
                <h5 class="card-title">{{$post->name}}</h5>
                <h6 class="card-text">{{$post->details}}</h6>
                <p style="color:gray;">wirtten by {{$post->username}}</p>
                <!-- <form action="/action_page.php"> -->
                  <div class="form-group">
                  <div class="form-group shadow-textarea">
                  <label for="exampleFormControlTextarea6">Comment :</label>
                  <textarea class="form-control z-depth-1" id="comment_input" rows="3" placeholder="Write Comment here..."></textarea>
                  </div>
                  </div>   
                  <button type="submit" class="btn btn-primary" id="send_comment">Send</button>
                <!-- </form> -->
            </div>          
        </div>
  
  
@endforeach
@endisset
   
       
</div>
    </div>
   </div>
   <h6  style="margin:5px">Comments :: </h6> 
  <div class="comments-list">

   @isset($comments)
   
   @foreach ($comments as $comment) 
        <div  class="card" style="margin:5px">
            <div class="card-body">
             
                <h6 class="card-text">{{$comment->comment}}</h6>
                <p style="color:gray;">wirtten by {{$comment->username}}</p>
            </div>
        </div>
   @endforeach
   @endisset
  </div>
</main>
<script >
  jQuery(document).ready(function($){


// CREATE
$("#send_comment").click(function (e) {
 //alert("added");
 

 var comment = $.trim($('#comment_input').val());  
  if (comment  == "") {
    alert("please enter comment .");
  }else{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = {
         // post_id:$(this).parent().find('.post_id').val() 
         post_id:$('.post_id').text(),
         comment_text:$('#comment_input').val()
    };
    var type = "POST";
    var ajaxurl = "{{url('/ajax/post/comment/add') }}";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            if(data.status == "success"){
                console.log(data);
            $(".comments-list").prepend('<div  class="card" style="margin:5px"><div class="card-body"><h6 class="card-text">'+data.comment
            +'</h6><p style="color:gray;">wirtten by '+data.name+'</p>'
            +' </div></div>');
            // alert("added");
            //location.reload();
            }else{
                console.log(data.message);
                alert(data.message);
            }
            
            
            
        },
        error: function (data) {
            console.log(data);
        }
    });
  }
  
    });
 });
 </script>

@endsection
