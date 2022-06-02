<?php
 
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// use Illuminate\Validation\Rule;
 
class PostController extends Controller
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
        $email = session()->get('key') ;
       
        $posts =  DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('users.email', '=', $email)
        ->get(['posts.*', 'users.name as username']);


        return view('users.posts.view',['error' =>"no posts data for you" ]);
        exit;
        if ($posts->isEmpty()) {
            // user doesn't exist
            return view('users.posts.view',['error' =>"no posts data for you" ]);
           
        }else{
            //print_r($posts);exit;
         
             return view('users.posts.view',['posts' => $posts]);
        }

    }
    public function add_post_GET(){
    

    }
    public function add_post_POST(){
    

    }
    public function edit_post_GET(){
    

    }
    public function edit_post_POST(){
    

    }
  
      
    
    
   
  
   
}