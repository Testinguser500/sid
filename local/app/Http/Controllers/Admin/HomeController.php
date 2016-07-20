<?php namespace App\Http\Controllers\Admin;
use App\User; 
use DB;
use Crypt;
use Auth;
use Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\cart\Cart;
use Session;
use Request;
use Image;
class HomeController extends Controller
{
	public function index(){   
             $this->middleware('guest');
             return view('admin/login');
		  
	}
        public function dashboard(){            
             return view('admin/dashboard')->with('title','Dashboard')->with('subtitle','Control Panel');
		
	}
	public function home(){ 
           
             return view('admin/home')->with('title','Admin')->with('subtitle','Control Panel');
		
	}
	public function log_user(){
           // echo Request::input('done');
			$validator = Validator::make(Request::all(), [          
		   'email' => 'required|email',
		   'password' => 'required|min:6',
		   
				]);
		  
		   if ($validator->fails()) {
			       $list[]='error';
			       $msg=$validator->errors()->all();
				   $list[]=$msg;
				   return $list;
				 
			 
		  }else{   
                    if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password'),  'role' =>1])) {
                        // Authentication passed...
                       if (Session::has('redirect_url'))
                       {
                            $value1 = Session::get('redirect_url');
							$list[]='success';
							$msgs[]=$value1;
							$list[]=$msgs;
							return $list;
                           
                        }
                        else{
							$list[]='success';
							$msgs[]='home';
							$list[]=$msgs;
							return $list;
                          
                         }
                    }else
                    {
						 $list[]='error';
						 $msgs[]='Your E-mail or Password is not correct';
						 $list[]=$msgs;
						return $list;
						  
                    
                    }
		  }
		 
	}
        public function log_out()
        {
            Auth::logout();
             return redirect('admins/login')->withFlash_message('You have successfully logout.')->withInput();
        }
       public function imageupload()
       {
        if(Request::input('folder'))
			$folder = '/'.Request::input('folder');
		
		if(Request::input('width')&&Request::input('height'))
		{
			$width = Request::input('width');
			$height = Request::input('height');
		}
		else
		{
			$width = 200;
			$height = 200;
		}
		
            $destinationPath = 'uploads'.$folder; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            if(($extension=='jpg') || ($extension=='jpeg') || ($extension=='png') ){
            $fileName = time().'.'.$extension; // renameing image 
			$path = ($destinationPath.'/'.$fileName);
			Image::make(Input::file('image')->getRealPath())->resize($width, $height)->save($path);	
			
            Input::file('image')->move($destinationPath, $fileName); 
            return $fileName;
            }else{
                return false;
            }
        
       }
 }
 
?>