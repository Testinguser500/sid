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
use File;
class HomeController extends Controller
{
	public function index(){   
             if (!Auth::check()) { 
                 return view('admin/login');
             }else{
                 return redirect('admins/home'); 
             }
		  
	}
        public function dashboard(){            
             return view('admin/dashboard')->with('title','Dashboard')->with('subtitle','Control Panel');
		
	}
	public function home(){ 
           if ((Auth::check()) &&  (Auth::user()->role==1) && (Auth::user()->status=='Active') ) { 
             return view('admin/home')->with('title','Admin')->with('subtitle','Control Panel');
           }else if((Auth::check()) && ((Auth::user()->role!=1) || (Auth::user()->status=='Inactive'))){                
             return redirect('admins/not_access');
           }
           else{
               return redirect('admins/login');
           }
		
	}
        public function not_access()
        {
            return view('admin/not_access')->with('title','Sorry')->with('subtitle','Not access');
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
                    if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password'),'role'=>1,'status'=>'Active'])) {
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
				$msgs[]='Fix your image dimension ('.Request::input('width').'x'.Request::input('height').') or size.';
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
	    Image::make(Input::file('image')->getRealPath())->resize(200, 200)->save($path);	
            $path = ($destinationPath.'/mid_'.$fileName);
	    Image::make(Input::file('image')->getRealPath())->resize(400, 400)->save($path);	
            Input::file('image')->move($destinationPath, $fileName); 
            return 'product/'.$fileName;
            }else{
                return false;
            }
	}
 }
 
?>