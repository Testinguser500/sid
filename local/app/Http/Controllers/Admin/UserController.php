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
        public function store(){
	
  
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
		 
        $password = (str_random(6));
        User::create(['image' =>Request::input('image'),'name' =>Request::input('name'),'email' =>Request::input('email'),'password'=>bcrypt($password),'gender'=>Request::input('gender'),'address'=>Request::input('address'),'status' =>Request::input('status'),'role'=>2]);  
		$emails['email'] = Request::input('email'); 
        $copyright=configs_value('Copyright');        
        $em_content=email_section('1');   
        $msg=$em_content->email_body;
        $msg=str_replace("{name}",Request::input('name'),$msg);
        $msg=str_replace("{role}",'Seller',$msg);
        $msg=str_replace("{site_name}",configs_value('Site Name'),$msg);
        $msg=str_replace("{username}",Request::input('email'),$msg);
        $msg=str_replace("{password}",$password,$msg);
        $msg=str_replace("{copyright}",$copyright,$msg);
        $emails['subject']= str_replace("{site_name}",$em_content->email_subject);
        $emails['name']= configs_value('Site Name');
        $emails['from']=configs_value('SMTP User');
		Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
			$message->from('test@infoseeksoftwaresystems.com', 'Laravel');

			$message->to($emails['email'])->subject($emails['subject']);
		});  
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
		 
          if(Request::input('image')){	 
         
         $fileName = Request::input('image'); // renameing image
         
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
		$msgs='Record updated successfully.';
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