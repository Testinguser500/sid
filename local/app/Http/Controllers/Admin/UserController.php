<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Category; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
use Hash;
use Crypt;
use Mail;

class UserController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $user = DB::table('users')->get();  
             return view('admin/user')->with('users_data',$user)->with('title','Users')->with('subtitle','List');
		
	}
	
	public function all(){ 
             $category = DB::table('users')->where('is_delete','=','0')->get();  
             return  $category;
		
	}
       public function add(){ 
             
             $user = DB::table('users')->get();  
             return view('admin/add_user')->with('users_data',$user)->with('title','User')->with('subtitle','Add');
		
	}
        public function store(Request $request){
	
  
	   $validator = Validator::make(Request::all(), [
            'name' => 'required',
			'email'=>'required|email|unique:users',
			
	    'image'=>'required',
                       
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
		 
        $destinationPath = 'uploads/user/'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        User::create(['image' =>$fileName,'name' =>$request->get('name'),'email' =>$request->get('email'),'password'=>bcrypt(str_random(6)),'gender'=>$request->get('gender'),'address'=>$request->get('address'),'status' =>$request->get('status'),'role'=>2]);  
		  
         $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;
	   
	}
        public function delete(Request $request){
	
	   $chk_id=Request::input('del_id');	
           $cat = User::find($chk_id);
           $cat->is_delete = '1';
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;
	    
	}
        
	 public function edit($id){
	
	 $data= DB::table('users')->where('id', '=',$id)->first();  
         $user = DB::table('users')->get();  
		 $return['user']=$data;
         $return['all_user']=$user;
	 //return view('admin/edit_user')->with('user_data',$user)->with('data',$data)->with('title','User')->with('subtitle','Edit');
	    return $return; 
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'name' => 'required',
			'email'=>'required|email',            
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
				  return $list;
        }
		 
          if(Input::file('image')!=''){	 
         $destinationPath = 'uploads/users/'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = User::find(Request::input('id'));
         $cat->name = Request::input('name');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
		 $cat->address =Request::input('address');
		 $cat->email=Request::input('email');
		 $cat->gender=Request::input('gender');
         $cat->status=Request::input('status');
         $cat->save(); 
		  
		$list[]='success';
		$msgs[]='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	     
	}
        
         public function sendEmailReminder(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
       
 }
 
?>