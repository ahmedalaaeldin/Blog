<?php
 
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// use Illuminate\Validation\Rule;
 
class AuthController extends Controller
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
       

    }
    public function logout(){
        if (session()->has('key')){
            session()->pull('key');
        }
            return view('login');
    }
    public function login_get(Request $request){
        //session()->pull('key');
        if (session()->has('key')){
            //  return  redirect()->route('adminMessageSetting');
            return redirect('/');
        }else{
            return view('login');
        }

    }
    public function login_post(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        //dd(session('isLogin'));
        $email = $request->input('email');
        $user = User::where('email',$email)->get();
        if ($user->isEmpty()) {
            // user doesn't exist
             return redirect('/login')->with('error', "your email is wrong");  
           
        }else{
            $name = null ;$password = null ;
            foreach ($user as $get_data) {
                 $name=$get_data->name;
                 $password=$get_data->password;
            }
            if(Hash::check($request->input('password'), $password)){
                $request->session()->put('key',$email);
    
                return  redirect('/');
            }else{
                    return redirect('/login')->with('error', "your password is wrong");  
            }
           
        }
        
      
    }
  
    public function register_get(Request $request)
    {
        //session()->pull('key');
        if (session()->has('key')){
            //  return  redirect()->route('adminMessageSetting');
            return redirect('/');
        }else{
            return view('registeration');
        }
    }
    public function register_post(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required'],
            'name' => ['required'],
            'password' => ['required'],
        ]);
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');
        try {
            User::create(array(
                'email' => $email,
                'name' => $name,
                'password' =>  Hash::make($password)
            ));
            return redirect('/register')->with("success","user registerd successfully.");
            // return view('registeration');
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
             $errorInfo = $exception->errorInfo;
             return redirect('/register')->with('error', $errorInfo[2]);  
             //print_r($errorInfo);
            // Return the response to the client..
        }
      
    	
    }
   
  
   
}