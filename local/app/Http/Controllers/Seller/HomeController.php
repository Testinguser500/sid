<?php namespace App\Http\Controllers\Seller;
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
use File;
class HomeController extends Controller
{
	public function index(){   
             if (!Auth::check()) { 
                 return view('seller/login');
             }else{
                 return redirect('seller/home'); 
             }		  
	}
        public function dashboard(){
		
             return view('seller/dashboard')->with('title','Dashboard')->with('subtitle','Control Panel');
		
	}
	public function profile()
	{
		return view('seller/profile')->with('title','Seller Profile');
	}
	public function all()
	{
		$seller = DB::table('users')->where('id','=',Auth::user()->id)->first();
		$return['seller']=$seller;
		return $return;
	}
	public function home(){ 
           if ((Auth::check()) &&  (Auth::user()->role==5) && (Auth::user()->status=='Active')) { 
             return view('seller/home')->with('title','Seller')->with('subtitle','Control Panel');
           }else if((Auth::check()) && ((Auth::user()->role!=5) || (Auth::user()->status=='Inactive'))){                
             return redirect('seller/not_access');
           }
           else{
               return redirect('seller/login');
           }
		
	}
        public function not_access()
        {
            return view('seller/not_access')->with('title','Sorry')->with('subtitle','Not access');
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
                    if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password'),'role'=>5,'status'=>'Active'])) {
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
             return redirect('seller/login')->withFlash_message('You have successfully logout.')->withInput();
        }
       public function imageupload()
       {
        if(Request::input('folder'))
			$folder = '/'.Request::input('folder');
		        $image= Input::file('image');
		if(Request::input('width')&&Request::input('height'))
		{
			//$width = Request::input('width');
			//$height = Request::input('height');
                        $image_info = getimagesize(Input::file('image'));
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
			$width = Request::input('width');
			$height = Request::input('height');
			if($image_width!=$width&&$image_height&&File::size($image)>1000)
			{
				$list[]='error';
				$msgs[]='Fix your image dimension or size.';
				$list[]=$msgs;
				return $list;
			}
		}
		else
		{
			$width = 200;
			$height = 200;
		}
		
            $destinationPath = 'uploads'.@$folder; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            if(($extension=='jpg') || ($extension=='jpeg') || ($extension=='png') ){
            $fileName = time().'.'.$extension; // renameing image 
			$path = ($destinationPath.'/thumb_'.$fileName);
			Image::make(Input::file('image')->getRealPath())->resize($width, $height)->save($path);	
			
            Input::file('image')->move($destinationPath, $fileName); 
            return $fileName;
            }else{
                return false;
            }
        
       }
	   public function Allimageupload()
       {
        if(Request::input('folder'))
			$folder = '/'.Request::input('folder');
		$image= Input::file('image');
		
		if(Request::input('width')&&Request::input('height'))
		{
			$image_info = getimagesize(Input::file('image'));
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
			$width = Request::input('width');
			$height = Request::input('height');
			if($image_width!=$width&&$image_height&&File::size($image)>1000)
			{
				$list[]='error';
				$msgs[]='Fix your image dimension or size.';
				$list[]=$msgs;
				return $list;
			}
			
		}
		else
		{
			$width = 200;
			$height = 200;
		}
		
            $destinationPath = 'uploads'.@$folder; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            if(($extension=='jpg') || ($extension=='jpeg') || ($extension=='png') ){
            $fileName = time().'.'.$extension; // renameing image 
			//thumb
			
			 $path = ($destinationPath . '/thumb_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
			//mid
			$path = ($destinationPath . '/mid_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
			
			
			
            Input::file('image')->move($destinationPath, $fileName); 
            return $fileName;
            }else{
                return false;
            }
        
       }
 
 
	/*******multiple images uploading*********/
	public function imagemutipleupload(){
		
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
	       $destinationPath = 'uploads'.@$folder; // upload path
	}
	
	public function update()
	{
		$id = Request::input('id');
		$validation = array(
				    'first_name'=>'required',
				    'last_name'=>'required',
				    'email'=>'required|email|unique:users,email,'.$id);
		if(Request::input('current_password')||Request::input('new_password')||Request::input('confirm_new_password'))
		{
			$validation['current_password']='required|min:6|check_password_match:current_password';
			$validation['new_password']='required|min:6';
			$validation['confirm_new_password']='required|same:new_password';
		}
		$validator = Validator::make(Request::all(),$validation);
		if ($validator->fails()) {
		$list[]='error';
		$msg=$validator->errors()->all();
		$list[]=$msg;
		return $list;
		}
		 $cat = User::find(Request::input('id'));
		 	$cat->fname = Request::input('first_name');
			$cat->lname = Request::input('last_name');
			$cat->email = Request::input('email');
			if(Request::input('new_password'))
			{
				$cat->password = bcrypt(Request::input('new_password'));
			}
			$cat->save();
			
			$list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	}
 }
 
?>