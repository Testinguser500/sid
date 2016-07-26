<?php namespace App\Http\Controllers\Admin;
use App\Seller; 
use App\Category; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Hash;
use Crypt;
use Mail;
use Image;

class SellerController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $user = DB::table('sellers')->where('role','=','3')->get();  
             return view('admin/seller')->with('users_data',$user)->with('title','Users')->with('subtitle','List');
		
	}
       public function add(){ 
             
             $user = DB::table('sellers')->get();  
             return view('admin/add_seller')->with('users_data',$user)->with('title','Seller')->with('subtitle','Add');
		
	}
	public function all(){ 
             $category = DB::table('sellers')->where('is_delete','=','0')->get();  
             return  $category;
		
	}
        public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'name' => 'required',
            'email'=>'required|email|unique:sellers',
            'image'=>'required',
            'mobile'=>'required|numeric|min:6',
            'company_name'=>'required',
            
            'company_pan_no'=>'required',
            'company_tin_no'=>'required',
            'company_address'=>'required',
            
              
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
			$msg=$validator->errors()->all();
			$list[]=$msg;
			return $list;
        }
		$password = (str_random(6));	 
        
        Seller::create(['image' =>Request::input('image'),'name' =>Request::input('name'),
            'email' =>Request::input('email'),
            'password'=>bcrypt($password),
            'gender'=>Request::input('gender'),
            'address'=>Request::input('address'),
            'mobile'=>Request::input('mobile'),
            'company_name'=>Request::input('company_name'),
            'company_pan_no'=>Request::input('company_pan_no'),
            'company_tin_no'=>Request::input('company_tin_no'),
            'company_address'=>Request::input('company_address'),
			'store_link'=>Request::input('store_link'),
            'status' =>Request::input('status'),
            //'menu_assign'=>implode(',',Request::input('menu_assign')),
            'role'=>3]);  
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
		$msg=str_replace("{link}",configs_value('Website'),$msg);
        $emails['subject']= str_replace("{site_name}",configs_value('Site Name'),$em_content->email_subject);
        $emails['name']= configs_value('Site Name');
        $emails['from']=configs_value('SMTP User');
		$emails['site_name']=configs_value('Site Name');
		Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
			$message->from($emails['from'], $emails['site_name']);

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
	
	 $data= DB::table('sellers')->where('id', '=',$id)->first();  
         $user = DB::table('sellers')->get();  
	 $return['user'] =$data;
	$return['all_user'] = $user;
	return $return;	 
	     
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
           'name' => 'required',
            'email'=>'required|email',
            
            'mobile'=>'required|numeric|min:6',
            'company_name'=>'required',
            
            'company_pan_no'=>'required',
            'company_tin_no'=>'required',
            'company_address'=>'required',
                        
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
			$msg=$validator->errors()->all();
			$list[]=$msg;
			return $list;
        }
		 
          if(Request::input('image')){	 
        $fileName = Request::input('image');
         }
         $cat = Seller::find(Request::input('id'));
         $cat->name = Request::input('name');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
                $cat->address =Request::input('address');
                $cat->email=Request::input('email');
                $cat->gender=Request::input('gender');
                $cat->mobile = Request::input('mobile');
                $cat->company_name=Request::input('company_name');
                $cat->company_pan_no=Request::input('company_pan_no');
                $cat->company_tin_no=Request::input('company_tin_no');
                $cat->company_address=Request::input('company_address');
				$cat->store_link=>Request::input('store_link'),
                //$cat->menu_assign=implode(',',Request::input('menu_assign'));
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