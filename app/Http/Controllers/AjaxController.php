<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File; 
use App\Models\PostsComments;
use App\Models\User;
 
class AjaxController extends Controller
{
    
    
    public function add_post_Comment(Request $request){
      
        if( session()->has('key') ){
            $email = session()->get('key') ;
            $user = User::where('email',$email)->get();
            $response = array();
            if ($user->isEmpty()) {
                $response = array(
                        'status' => 'failed',
                        'message' =>  "please check autherization for your account" ,    
                );
            }else{
                try {
                    PostsComments::create(array(
                        'comment' =>  $request->comment_text ,
                        'user_id' =>   $user[0]->id ,
                        'post_id' =>  $request->post_id  
                    ));
                    $response = array(
                        'status' => 'success',
                        'message' =>  "comment added" , 
                        'comment' =>   $request->comment_text ,    
                        'name' =>  $user[0]->name     
    
                    );
                    // return view('registeration');
                } catch (\Illuminate\Database\QueryException $exception) {
                    // You can check get the details of the error using `errorInfo`:
                     $errorInfo = $exception->errorInfo;
                     $response = array(
                        'status' => 'failed',
                        'message' =>  $errorInfo[2] ,    
                    );
                  
                     //print_r($errorInfo);
                    // Return the response to the client..
                }
                // test
                // $response = array(
                //     'status' => 'success',
                //     'comment' =>  $request->comment_text ,
                //     'user_id' =>  $user[0]->id ,
                //     'post_id' =>  $request->post_id  
                // );
            
               
            }

        }else{
            $response = array(
                'status' => 'failed',
                'message' =>  "please login firstly to can comment." ,    
            );
          
        }
       
      
       
        return response()->json($response);
    }
  
}