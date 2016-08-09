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
	 $role = Request::input('role');
		if($role)
		{
			$user = DB::table('users')->select('role.name as role_name', 'users.*')->join('role', 'users.role', '=', 'role.id')->where('users.role','=',$role)->where('is_delete','=','0')->get();
			//print_r($user);
		}
		else
		{
			$user = DB::table('users')->select('role.name as role_name', 'users.*')->join('role', 'users.role', '=', 'role.id')->where('is_delete','=','0')->get();
			//print_r($user);
		}
			$country = DB::table('country')->where('is_delete','=','0')->where('pid','=','0')->get();
			$category = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
			$role = DB::table('role')->get();
			$totalData = DB::table('role')->leftjoin('users','role.id','=','users.role')->select(DB::raw('count(users.id) as total_users,role.name,role.id as role_id'))->where('users.is_delete','=','0')->groupBy('users.role')->get();	
					
             $return['users'] =  $user;
			 $return['country'] =  $country;
			 $return['roles'] =  $role;
			 $return['category'] = $category;
			 $return['total'] = $totalData;
			 return $return;
		
	}
	public function changeRole()
	{
		$chk_id = Request::input('id');
		 $role = Request::input('role');
		foreach((array)$chk_id as $key=>$id)
	   {
		   if($id)
			   $user_id[]=$key;
	   }
		
		$array = (array_filter($user_id));
		DB::table('users')
            ->whereIn('id', $array)
            ->update(['role' => $role]);
			
			$list[]='success';
			$msg='Role has been changed successfully.';
			$list[]=$msg;
		return $list;
		
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
			
	
	);
	if(Request::input('ownpassword')==0)
	{
		$validation['confirm_password'] = 'required|same:password';
	}
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
	public function checkLink()
	{
	    $link=Request::input('store_link');
	    $store_id = Request::input('store_id');
	    if($link)
	    {
			if($store_id)
			{
				    
			$validation = array(
				    'store_link'=>'required|unique:store,store_link,'.Request::input('store_id')
			);
			}
			else
			{
			$validation = array(
				    'store_link'=>'unique:store'
			);	    
			}
			$validator = Validator::make(Request::all(), $validation);
			 if ($validator->fails()) {
				$lists[]='error';
				$msg=$validator->errors()->all();
				$lists[]=$msg;
				return $lists;
			}
		$lists='success';
		return $lists;
	    }
	}
        public function store(){
			
			//echo Request::input('fname');
			
			$validation1=array();
	$validation = array(
			'role'=>'required',
			'fname' => 'required',
			'username' => 'required|unique_with:users,role',
			'email'=>'required|email|unique_with:users,role',
			//'password'=>'required|min:6',
			//'profile_image'=>'required',
			'mobile' => 'required|unique_with:users,role',
	
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
		'banner'=>'required|max:1000',
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
        $user = User::create(['image' =>Request::input('profile_image'),'fname' =>Request::input('fname'),'lname' =>Request::input('lname'),'username' =>Request::input('username'),'email' =>Request::input('email'),'password'=>bcrypt($password),'gender'=>Request::input('gender'),'website' =>Request::input('website'),'mobile' =>Request::input('mobile'),'home_number' =>Request::input('home_number'),'address'=>Request::input('address'),'nationality' =>Request::input('nationality'),'country' =>Request::input('country'),'state' =>Request::input('state'),'city' =>Request::input('city'),'bio' =>Request::input('bio'),'status' =>Request::input('status'),'role'=>Request::input('role')]);  
		$insert_id = $user->id;
		//if(Request::input('role')==3)
		//{
			Shipping::create(['user_id'=>$insert_id,'ship_fname'=>Request::input('ship_fname'),'ship_lname'=>Request::input('ship_lname'),'ship_mobile'=>Request::input('ship_mobile'),'ship_address'=>Request::input('ship_address'),'ship_country'=>Request::input('ship_country'),'ship_state'=>Request::input('ship_state'),'ship_city'=>Request::input('ship_city')]);
		//}
		//elseif(Request::input('role')==5)
		//{
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
		//}
		if(Request::input('notify'))
		{
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
		}
		$list[]='success';
		$list[]='Record is added successfully.';	 
	    return $list;
	   
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           $cat = User::find($chk_id);
           $cat->is_delete = '1';
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;
	    
	}
	public function deleteAll(){
	
	    $action = Request::input('action');
	   $chk_id=Request::input('id');
	   foreach((array)$chk_id as $key=>$id)
	   {
		   if($id)
			   $user_id[]=$key;
	   }
		if($action=='delete')	   
		{
			DB::table('users')
            ->whereIn('id', $user_id)
            ->update(['is_delete' => '1']);
		
			$list[]='success';
			$list[]='Record is deleted successfully.';	 
			return $list;
		}
		
	    
	}
	public function changeStatus()
	{
		$id = Request::input('id');
		$action = Request::input('status');
		if($action=='Active'){
			$status ='Inactive';
		}
		else if($action=='Inactive')
		{
			$status = 'Active';
		}
		else if($action=='Block')
		{
			$status = 'Block';
		}
		
		$cat = User::find($id);
           $cat->status = $status;
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='User status has been changed successfully.';	 
	   return $list;
	}
        
	 public function edit($id){
	
	 $data= DB::table('users')->join('role','users.role', '=', 'role.id')->select('role.name as role_name','users.fname as user_fname','users.lname as user_lname', 'users.*','role.id as roleid','users.id as userid')->where('users.id', '=',$id)->first();
	 //print_r($data);
	 $role = DB::table('role')->get();
	 $user = '';
		if($data->role=='5')
		{
		$user = DB::table('store')->select('*','id as store_id')->where('user_id', '=',$id)->first();
		if($user)
		{
		$afiliate = DB::table('affiliate')->select('*','id as affiliate_id')->where('store_id','=',$user->store_id)->get();
		$user->affiliate = $afiliate;
		}
		}
		elseif($data->role=='3')
		{
		$user = DB::table('shipp_address')->select('*','id as shipp_id')->where('user_id', '=',$id)->where('ship_status','=','Active')->first();
		}
		$category = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
		//print_r($user);
		 $return['user']=(object) array_merge((array)$data,(array) $user);
		 //print_r($return['user']);
         $return['all_user']=$user;
		 $return['roles']=$role;
		 $return['category'] = $category;
	 
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
         $cat->fname = Request::input('fname');
		 $cat->lname = Request::input('lname');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
		 
		 $cat->username =Request::input('username');
		
		 $cat->email =Request::input('email');
		 if(Request::input('password'))
			 $cat->password= bcrypt(Request::input('password'));
		 
		 $cat->gender=Request::input('gender');
		 $cat->website =Request::input('website');
		 $cat->mobile =Request::input('mobile');
		 $cat->home_number =Request::input('home_number');
		 $cat->address=Request::input('address');
		 $cat->nationality =Request::input('nationality');
		 $cat->country =Request::input('country');
		 $cat->bio =Request::input('bio');
		 $cat->status =Request::input('status');
		 $cat->role=Request::input('role');
         $cat->save(); 
		  
		 //if(Request::input('role')==3)
		 //{
			$shipp = Shipping::find(Request::input('shipp_id'));
			$shipp->ship_fname=Request::input('ship_fname');
			$shipp->ship_lname=Request::input('ship_lname');
			$shipp->ship_mobile=Request::input('ship_mobile');
			$shipp->ship_address=Request::input('ship_address');
			$shipp->ship_country=Request::input('ship_country');
			$shipp->ship_state=Request::input('ship_state');
			$shipp->ship_city=Request::input('ship_city');
			$shipp->save();
			
		 //}
		 //elseif(Request::input('role')==5)
		 //{
			$store = Store::find(Request::input('store_id'));
			$store->store_name = Request::input('store_name');
			if(Request::input('banner'))
			$store->banner = Request::input('banner');
			if(Request::input('logo'))
			$store->logo = Request::input('logo');
		
			$store->store_country = Request::input('store_country');
			$store->store_state = Request::input('store_state');
			$store->store_city = Request::input('store_city');
			$store->store_address = Request::input('store_address');
			$store->phone = Request::input('store_phone');
			$store->facebook_link = Request::input('facebook_link');
			$store->google_link = Request::input('google_plus_link');
			$store->twitter_link = Request::input('twitter_link');
			$store->linkedin_link = Request::input('linkedin_link');
			$store->youtube_link = Request::input('youtube_link');
			$store->instagram_link = Request::input('instagram_link');
			$store->flickr_link = Request::input('flickr_link');
			$store->selling = Request::input('selling');
			$store->publishing = Request::input('publishing');
			$store->commission = Request::input('commission');
			$store->featured = Request::input('featured');
			$store->verified = Request::input('verified');
			$store->promotinoal_link = Request::input('promotinoal_link');
			$store->promotion_banner = Request::input('promotion');
			$store->save();
			
			if(Request::input('affiliatefees'))
			{
				$store_id= Request::input('store_id');
				DB::table('affiliate')->where('store_id','=',$store_id)->delete();
				$affiliatefees = Request::input('affiliatefees');
				//print_r($affiliatefees);
				foreach((array)$affiliatefees as $aff)
				{
				Affiliate::create(['user_id'=>Request::input('id'),'store_id'=>$store_id,'category_id'=>$aff['category_id'],'fees'=>$aff['fees']]);
				}
			}
		 //}
		  
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
	
	public function getProfileImage()
	{
		$email = Request::input('email');
		$name = Request::input('name');
		 $data = file_get_contents('http://www.avatarapi.com/js.aspx?email='.$email.'&size=128');
		if($data=='// No profile information found for this email')
		{
			$img = \DefaultProfileImage::create($name, 150, '#000', '#FFF');
			$fileName = time().'.png';
			//echo base_path('../uploads');
			//dd(asset('uploads'));
			$inPublic = 'uploads';
			//echo public_path($inPublic);
			//echo $localPath = str_replace('local\public','',(public_path()));
			//echo storage_path();
			echo $path = asset('local/storage/app/');
			\Storage::put('uploads/'.$fileName, $img->encode());
			return "<a ><img src='".$path."/uploads/".$fileName."'  width='128' height='128></a>";
		}
		else
		{
			return $data;
		}
	}
       
 }
 
?>