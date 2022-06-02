<?php
 
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Posts;

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


      
        if ($posts->isEmpty()) {
            // user doesn't exist
            return view('users.posts.view',['error' =>"no posts data for you" ]);
           
        }else{
            //print_r($posts);exit;
         
             return view('users.posts.view',['posts' => $posts]);
        }

    }
    public function add_post_GET(){
    
        if (session()->has('key')){
           
            return view('users.posts.create');
         
        }else{
            return redirect('/login');
        }
    }
    public function add_post_POST(Request $request){
            $credentials = $request->validate([
                'details' => ['required'],
                'name' => ['required']
            ]);
            $name = $request->input('name');
            $details = $request->input('details');
            if (session()->has('key')){
                $email = session()->get('key');
                $user = User::where('email',$email)->get();
                try {
                Posts::create([
                    'name' => $name,
                    'details' => $details,
                    'user_id' => $user[0]->id
                ]);
                return redirect()->back()->with("success","Post added successfully.");
                } catch (\Illuminate\Database\QueryException $exception) {
                    $errorInfo = $exception->errorInfo;
                    return redirect()->back()->with('error', $errorInfo[2]);  
                    //print_r($errorInfo);
                   // Return the response to the client..
                }
                
            }else{
                return redirect('/login');
            }
          

    }
    public function edit_post_GET($id){
        $email = session()->get('key');
        if (session()->has('key')){
            if(empty($id)){
                return redirect()->back()->with('error', "ID is empty");  
            }else{
                $post =  DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->where('posts.id', '=',$id )
                ->where('users.email', '=', $email)
                ->get(['posts.*', 'users.name as username']);

                if ($post->isEmpty()) {
                    // user doesn't exist
                    return view('users.posts.edit',['error' =>"no data for this ID#".$id ]);
                   
                }else{
                return view('users.posts.edit',['post' => $post]);
                }
            }
           
        }else{
            return redirect('/login');
           
        }

    }
    public function edit_post_POST(Request $request ,$id){
        $credentials = $request->validate([
            'details' => ['required'],
            'name' => ['required']
        ]);
        $name = $request->input('name');
        $details = $request->input('details');
        if (session()->has('key')){
            $email = session()->get('key');
            $user = User::where('email',$email)->get();
            try {
                Posts::where('id', $id)
                ->update(['name' => $name,'details' => $details]);
            
            // return view('users.posts.edit',["success"=>"Post edited successfully."]);
             return redirect()->back()->with('success', "Post edited successfully.");  
            } catch (\Illuminate\Database\QueryException $exception) {
                $errorInfo = $exception->errorInfo;
                return view('users.posts.edit',["error"=> $errorInfo[2]]);
                //return redirect()->back()->with('error', $errorInfo[2]);  
                //print_r($errorInfo);
               // Return the response to the client..
            }
            
        }else{
            return redirect('/login');
        }

    }
  
      
    
    
   
  
   
}