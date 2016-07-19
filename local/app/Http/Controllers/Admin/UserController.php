<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Category; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
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
       public function add(){ 
             
             $user = DB::table('users')->get();  
             return view('admin/add_user')->with('users_data',$user)->with('title','User')->with('subtitle','Add');
		
	}
        public function store(Request $request){
	
  
	   $validator = Validator::make($request->all(), [
            'name' => 'required',
			'email'=>'required|email|unique:users',
			
	    'image'=>'required',
                       
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/user/add')
                        ->withErrors($validator)
                        ->withInput();
        }
		 
        $destinationPath = 'uploads/user/'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        User::create(['image' =>$fileName,'name' =>$request->get('name'),'email' =>$request->get('email'),'password'=>bcrypt(str_random(6)),'gender'=>$request->get('gender'),'address'=>$request->get('address'),'status' =>$request->get('status'),'role'=>2]);  
		  
         return redirect('/admin/user')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	  
	   DB::table('users')->where('id', '=',$chk_id)->delete();		 
           return  redirect('/admin/user')->withFlash_message('Record Deleted  Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $data= DB::table('users')->where('id', '=',$id)->first();  
         $user = DB::table('users')->get();  
	 return view('admin/edit_user')->with('user_data',$user)->with('data',$data)->with('title','User')->with('subtitle','Edit');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'name' => 'required',
			'email'=>'required|email',            
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/user/edit/'.$request->get('user_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
		 
          if(Input::file('image')!=''){	 
         $destinationPath = 'uploads/users/'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = User::find($request->get('user_id'));
         $cat->name = $request->get('name');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
		 $cat->address =$request->get('address');
		 $cat->email=$request->get('email');
		 $cat->gender=$request->get('gender');
         $cat->status=$request->get('status');
         $cat->save(); 
		  
         return redirect('/admin/user')->withFlash_message('Record updated Successfully.');
	     
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