<?php
 
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;


// use Illuminate\Validation\Rule;
 
class HomeController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts =  DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        // ->leftjoin('posts_comments', 'posts.id', '=', 'posts_comments.post_id')
        // ->where('followers.follower_id', '=', 3)
        ->get(['posts.*', 'users.name as username']);


        
        if ($posts->isEmpty()) {
            // user doesn't exist
            return view('home',['error' =>"no posts data" ]);
           
        }else{
            //print_r($posts);exit;
         
             return view('home',['posts' => $posts]);
        }
        
    }
    public function viewPost($id)
    {
        $posts =  DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('posts.id', '=', $id)
        ->get(['posts.*', 'users.name as username']);

        $post_comments =  DB::table('posts')
        ->leftjoin('posts_comments', 'posts.id', '=', 'posts_comments.post_id')
        ->leftjoin('users', 'posts_comments.user_id', '=', 'users.id')
        ->where('posts_comments.post_id', '=', $id)
        ->orderBy('posts_comments.id', 'DESC')
        ->get(['posts_comments.*','users.name as username']);
        
        if ($posts->isEmpty()) {
            // user doesn't exist
            return view('view-post-home',['error' =>"no post data for this id".$id ]);
           
        }else{
            //print_r($posts);exit;
         
           return view('view-post-home',['posts' => $posts,'comments'=>$post_comments]);
        }
        

    }
  
   
  
   
}