<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Category; 
use App\Shipping;
use App\Store;
use App\Affiliate;
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
             $user = DB::table('users')->select('role.name as role_name', 'users.*')->join('role', 'users.role', '=', 'role.id')->where('is_delete','=','0')->get();
			$country = DB::table('country')->where('is_delete','=','0')->where('pid','=','0')->get();
			$category = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
			$role = DB::table('role')->get();			
             $return['users'] =  $user;
			 $return['country'] =  $country;
			 $return['roles'] =  $role;
			 $return['category'] = $category;
			 return $return;
		
	}
       public function add(){ 
             
             $user = DB::table('users')->get();  
             return view('admin/add_user')->with('users_data',$user)->with('title','User')->with('subtitle','Add');
		
	}
	public function checkUser(){
		$validation = array(
			'role'=>'required',
			'username' => 'required|unique_with:users,role',
			'email'=>'required|email|unique_with:users,role',
			'password'=>'required|min:6',
			'confirm_password'=>'required|same:password',
	
	);
	$validator = Validator::make(Request::all(), $validation);
		
         
        if ($validator->fails()) {
				$list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
		$list[]='success';
		return $list;
	}
        public function store(){
			
			echo Request::input('fname');
			
			$validation1=array();
	$validation = array(
			'role'=>'required',
			'fname' => 'required',
			'username' => 'required|unique_with:users,role',
			'email'=>'required|email|unique_with:users,role',
			'password'=>'required|min:6',
			'confirm_password'=>'required|same:password',
			'profile_image'=>'required',
	
	);
	if(Request::input('role')==3)
	{
		$validation1 = array('ship_fname'=>'required',
		'ship_mobile'=>'required',
		'ship_address'=>'required',
		'ship_country'=>'required',
		'ship_state'=>'required',
		'ship_city'=>'required',
		);
	}
	elseif(Request::input('role')==5)
	{
		$validation1 = array(
		'banner'=>'required',
		'store_country'=>'required',
		'store_state'=>'required',
		'store_city'=>'required',
		'store_address'=>'required',
		'store_phone'=>'required'
		);
	}
  $arrayData = array_merge($validation,$validation1);
	   $validator = Validator::make(Request::all(), $arrayData);
		
         
        if ($validator->fails()) {
				$list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
		 
        $password = Request::input('password');
        $user = User::create(['image' =>Request::input('profile_image'),'fname' =>Request::input('fname'),'lname' =>Request::input('lname'),'display_name' =>Request::input('display_name'),'username' =>Request::input('username'),'nickname' =>Request::input('nickname'),'email' =>Request::input('email'),'password'=>bcrypt($password),'gender'=>Request::input('gender'),'website' =>Request::input('website'),'mobile' =>Request::input('mobile'),'address'=>Request::input('address'),'nationality' =>Request::input('nationality'),'country' =>Request::input('country'),'bio' =>Request::input('bio'),'status' =>Request::input('status'),'role'=>Request::input('role')]);  
		$insert_id = $user->id;
		if(Request::input('role')==3)
		{
			Shipping::create(['user_id'=>$insert_id,'ship_fname'=>Request::input('ship_fname'),'ship_lname'=>Request::input('ship_lname'),'ship_mobile'=>Request::input('ship_mobile'),'ship_address'=>Request::input('ship_address'),'ship_country'=>Request::input('ship_country'),'ship_state'=>Request::input('ship_state'),'ship_city'=>Request::input('ship_city')]);
		}
		elseif(Request::input('role')==5)
		{
			$store = Store::create(['user_id'=>$insert_id,
			'store_name'=>Request::input('store_name'),
			'store_link'=>Request::input('store_link'),
			'store_address'=>Request::input('store_address'),
			'store_country'=>Request::input('store_country'),
			'store_state'=>Request::input('store_state'),
			'store_city'=>Request::input('store_city'),
			'phone'=>Request::input('store_phone'),
			'banner'=>Request::input('banner'),
			'facebook_link'=>Request::input('facebook_link'),
			'google_link'=>Request::input('google_plus_link'),
			'twitter_link'=>Request::input('twitter_link'),
			'linkedin_link'=>Request::input('linkedin_link'),
			'youtube_link'=>Request::input('youtube_link'),
			'instagram_link'=>Request::input('instagram_link'),
			'flickr_link'=>Request::input('flickr_link'),'store_status'=>'Inactive',
			'selling'=>Request::input('selling'),
			'publishing'=>Request::input('publishing'),
			'commission'=>Request::input('commission'),
			'featured'=>Request::input('featured'),
			'verified'=>Request::input('verified'),
			'promotinoal_link'=>Request::input('promotinoal_link'),
			'promotion_banner'=>Request::input('promotion'),
			'logo'=>Request::input('logo')]);
			$store_id = $store->id;
			$affiliatefees = Request::input('affiliatefees');
			foreach((array)$affiliatefees as $aff)
			{
			Affiliate::create(['user_id'=>$insert_id,'store_id'=>$store_id,'category_id'=>$aff['affiliate'],'fees'=>$aff['value']]);
			}
		}
		$emails['email'] = Request::input('email'); 
        $copyright=configs_value('Copyright');        
        $em_content=email_section('1');   
        $msg=$em_content->email_body;
        $msg=str_replace("{name}",Request::input('name'),$msg);
        $msg=str_replace("{role}",'User',$msg);
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
	
	 $data= DB::table('users')->join('role','users.role', '=', 'role.id')->select('role.name as role_name','users.fname as user_fname','users.lname as user_lname', 'users.*','role.id as roleid','users.id as userid')->where('users.id', '=',$id)->first();
	 //print_r($data);
	 $role = DB::table('role')->get();
	 $user = '';
		if($data->role=='5')
		$user = DB::table('store')->select('*','id as store_id')->where('user_id', '=',$id)->first();
		elseif($data->role=='3')
		$user = DB::table('shipp_address')->select('*','id as shipp_id')->where('user_id', '=',$id)->where('ship_status','=','Active')->first();
		//print_r($user);
		 $return['user']=(object) array_merge((array)$data,(array) $user);
		 //print_r($return['user']);
         $return['all_user']=$user;
		 $return['roles']=$role;
	 //return view('admin/edit_user')->with('user_data',$user)->with('data',$data)->with('title','User')->with('subtitle','Edit');
	    return $return; 
	}
         public function update(){
	//print_r(Request::all());
	 $validation1=array();
	$validation = array(
			'role'=>'required',
			'fname' => 'required',
			'username' => 'required|unique_with:users,role,'.Request::input('id'),
			'email'=>'required|email|unique_with:users,role,'.Request::input('id'),
			'password'=>'min:6',
			'confirm_password'=>'same:password',
			
	
	);
	if(Request::input('role')==3)
	{
		$validation1 = array('ship_fname'=>'required',
		'ship_mobile'=>'required',
		'ship_address'=>'required',
		'ship_country'=>'required',
		'ship_state'=>'required',
		'ship_city'=>'required',
		);
	}
	elseif(Request::input('role')==5)
	{
		$validation1 = array(
		
		'store_country'=>'required',
		'store_state'=>'required',
		'store_city'=>'required',
		'store_address'=>'required',
		'store_phone'=>'required'
		);
	}
  $arrayData = array_merge($validation,$validation1);
  $validator = Validator::make(Request::all(), $arrayData);
         
        if ($validator->fails()) {
            $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
				  return $list;
        }
		 
          if(Request::input('image')){	 
         
         $fileName = Request::input('profile_image'); // renameing image
         
         }
         $cat = User::find(Request::input('id'));
         $cat->name = Request::input('name');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
		 
		 $cat->username =Request::input('username');
		 $cat->nickname =Request::input('nickname');
		 $cat->email =Request::input('email');
		 if(Request::input('password'))
			 $cat->password= bcrypt(Request::input('password'));
		 
		 $cat->gender=Request::input('gender');
		 $cat->website =Request::input('website');
		 $cat->mobile =Request::input('mobile');
		 $cat->address=Request::input('address');
		 $cat->nationality =Request::input('nationality');
		 $cat->country =Request::input('country');
		 $cat->bio =Request::input('bio');
		 $cat->status =Request::input('status');
		 $cat->role=Request::input('role');
         $cat->save(); 
		  
		 if(Request::input('role')==3)
		 {
			$shipp = Shipping::find(Request::input('shipp_id'));
			$shipp->name=Request::input('ship_name');
			$shipp->mobile=Request::input('ship_mobile');
			$shipp->address=Request::input('ship_address');
			$shipp->ship_country=Request::input('ship_country');
			$shipp->state=Request::input('ship_state');
			$shipp->city=Request::input('ship_city');
			$shipp->save();
			
		 }
		 elseif(Request::input('role')==5)
		 {
			$store = Store::find(Request::input('store_id'));
			$store->store_name = Request::input('store_name');
			if(Request::input('banner'))
			$store->banner = Request::input('banner');
			$store->store_country = Request::input('store_country');
			$store->store_state = Request::input('store_state');
			$store->store_city = Request::input('store_city');
			$store->store_address = Request::input('store_address');
			$store->phone = Request::input('store_phone');
			$store->facebook_link = Request::input('facebook_link');
			$store->google_link = Request::input('google_link');
			$store->twitter_link = Request::input('twitter_link');
			$store->linkedin_link = Request::input('linkedin_link');
			$store->youtube_link = Request::input('youtube_link');
			$store->instagram_link = Request::input('instagram_link');
			$store->flickr_link = Request::input('flickr_link');
			$store->save();
		 }
		  
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