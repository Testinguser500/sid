<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Category; 
use App\Product;
use App\SpecialOffer;
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

class SpecialOfferController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             //$user = DB::table('users')->get();  
             return view('admin/special_offer')->with('title','Special Offer')->with('subtitle','List');
		
	}
	
	public function all(){ 
	 
	 $data = DB::table('offers')->where('is_delete','=',0)->where('method','=','special')->get();
	     $return['offers']=$data;
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
			
	    //print_r(Request::all());
	    $validation = array(
				'rule_name'=>'required',
				'from_date'=>'required',
				'end_date'=>'required',
				'apply_to'=>'required',
				'customers'=>'required',
				'amount_purchase'=>'required|numeric',
				'products_adujst'=>'required',
				'amount_adjust'=>'required|numeric',
				'adjustment_type'=>'required',
				'adjustment_value'=>'required|numeric'
				);
	    if(Request::input('apply_to')=='categories_include'||Request::input('apply_to')=='categories_exclude')
	    {
			$validation['category_list']='required';
	    }
	    elseif(Request::input('apply_to')=='products_include'||Request::input('apply_to')=='products_exclude')
	    {
			$validation['product_list']='required';
	    }
	    if(Request::input('customers')=='roles_include'||Request::input('customers')=='roles_exclude')
	    {
			$validation['role_list']='required';
	    }
	    elseif(Request::input('customers')=='users_include'||Request::input('customers')=='users_exclude')
	    {
			$validation['customer_list']='required';
	    }
	    if(Request::input('products_adujst')=='other_categories')
	    {
			$validation['specific_category']='required';
	    }
	    elseif(Request::input('products_adujst')=='other_products')
	    {
			$validation['specific_product']='required';
	    }
	    
	    $validator = Validator::make(Request::all(), $validation);
	    if ($validator->fails()) {
				$lists[]='error';
				$msg=$validator->errors()->all();
				$lists[]=$msg;
				return $lists;
			}
	    //$products = Request::input('products');
	    $category_list = Request::input('category_list');
	    $product_list = Request::input('product_list');
	    $role_list = Request::input('role_list');
	    $customer_list = Request::input('customer_list');
	    $specific_category = Request::input('specific_category');
	    $specific_product = Request::input('specific_product');
	    $products_id=array();
	    $category_id=array();
	    $rol_id=array();
	    $customer_id=array();
	    $specific_category_id=array();
	    $specific_product_id=array();
	    foreach((array)$product_list as $val)
	    {
			$products_id[]=$val['id'];
	    }
	    foreach((array)$category_list as $val)
	    {
			$category_id[]=$val['id'];
	    }
	    foreach((array)$category_list as $val)
	    {
			$category_id[]=$val['id'];
	    }
	    foreach((array)$role_list as $val)
	    {
			$rol_id[]=$val['id'];
	    }
	    foreach((array)$customer_list as $val)
	    {
			$customer_id[]=$val['id'];
	    }
	    foreach((array)$specific_category as $val)
	    {
			$specific_category_id[]=$val['id'];
	    }
	    foreach((array)$specific_product as $val)
	    {
			$specific_product_id[]=$val['id'];
	    }
	    
	    $cat= SpecialOffer::create(['offer_name'=>Request::input('rule_name'),
				    'method'=>Request::input('method'),
				    'quantity_based_on'=>Request::input('quantity_based_on'),
				    'condition_match'=>Request::input('condition_match'),
				    'start_date'=>Request::input('from_date'),
				    'end_date'=>Request::input('end_date'),
				    'apply_to'=>Request::input('apply_to'),
				    'product_list'=>implode(',',$products_id),
				    
				    'customers'=>Request::input('customers'),
				    'category_list'=>implode(',',$category_id),
				    'role_list'=>implode(',',$rol_id),
				    'customer_list'=>implode(',',$customer_id),
				    'amount_purchase'=>Request::input('amount_purchase'),
				    'products_adujst'=>Request::input('products_adujst'),
				    'specific_category'=>implode(',',$specific_category_id),
				    'specific_product'=>implode(',',$specific_product_id),
				    'amount_adjust'=>Request::input('amount_adjust'),
				    'adjustment_type'=>Request::input('adjustment_type'),
				    'adjustment_value'=>Request::input('adjustment_value'),
				    
				    
				    ]);
		$list[]='success';
		$list[]='Record is added successfully.';	 
	    return $list;
	   
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           $cat = SpecialOffer::find($chk_id);
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
		
		$cat = SpecialOffer::find($id);
           $cat->offer_status = $status;
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='User status has been changed successfully.';	 
	   return $list;
	}
        
	 public function edit($id){
	$userEmail='';
	$pro_id='';
	$specific_product='';
	$cat_id='';
	$specific_category='';
	$role_list='';
	
	 $cate= DB::table('offers')->where('id', '=',$id)->first();
	 if($cate->product_list)
	 $pro_id = explode(',',$cate->product_list);
	 
	 if($cate->category_list)
	 $cat_id = explode(',',$cate->category_list);
	 
	 if($cate->role_list)
	 $role_list = explode(',',$cate->role_list);
	 
	 if($cate->customer_list)
	 $customer_list = explode(',',$cate->customer_list);
	 if($cate->specific_category)
	 $specific_category = explode(',',$cate->specific_category);
	 
	 if($cate->specific_product)
	 $specific_product = explode(',',$cate->specific_product);
	 
	 
	 //$category = DB::table('coupons')->where('is_delete', '=','0')->get();
	 $cate->product_data = DB::table('product')->whereIn('id',$pro_id)->get();
	 $cate->spproduct_data = DB::table('product')->whereIn('id',$specific_product)->get();
	 $cate->category_data = DB::table('categorys')->whereIn('id',$cat_id)->get();
	 $cate->spcategory_data = DB::table('categorys')->whereIn('id',$specific_category)->get();
	 $cate->role_data = DB::table('role')->whereIn('id',$role_list)->get();
	 if($cate->customer_list)
	 $cate->user_data = DB::select("select id,CONCAT(fname,' ',lname) as name from users where id IN (".$cate->customer_list.")");
	 //$user_email =explode(',',$cate->user_email);
	 //foreach((array)$user_email as $val)
	 //{
	 //   $userEmail[]=array('email'=>$val);
	 //}
	 //$cate->user_email = $userEmail;
         $return['offer']=$cate;
         //$return['all_coupon']=$category;
	 return $return;
	     
	}
         public function update(){
	//print_r(Request::all());
	$validation = array(
				'rule_name'=>'required',
				'from_date'=>'required',
				'end_date'=>'required',
				'apply_to'=>'required',
				'customers'=>'required',
				'amount_purchase'=>'required|numeric',
				'products_adujst'=>'required',
				'amount_adjust'=>'required|numeric',
				'adjustment_type'=>'required',
				'adjustment_value'=>'required|numeric'
				);
	    if(Request::input('apply_to')=='categories_include'||Request::input('apply_to')=='categories_exclude')
	    {
			$validation['category_list']='required';
	    }
	    elseif(Request::input('apply_to')=='products_include'||Request::input('apply_to')=='products_exclude')
	    {
			$validation['product_list']='required';
	    }
	    if(Request::input('customers')=='roles_include'||Request::input('customers')=='roles_exclude')
	    {
			$validation['role_list']='required';
	    }
	    elseif(Request::input('customers')=='users_include'||Request::input('customers')=='users_exclude')
	    {
			$validation['customer_list']='required';
	    }
	    if(Request::input('products_adujst')=='other_categories')
	    {
			$validation['specific_category']='required';
	    }
	    elseif(Request::input('products_adujst')=='other_products')
	    {
			$validation['specific_product']='required';
	    }
	    
	    $validator = Validator::make(Request::all(), $validation);
	    if ($validator->fails()) {
				$lists[]='error';
				$msg=$validator->errors()->all();
				$lists[]=$msg;
				return $lists;
			}
	 $category_list = Request::input('category_list');
	    $product_list = Request::input('product_list');
	    $role_list = Request::input('role_list');
	    $customer_list = Request::input('customer_list');
	    $specific_category = Request::input('specific_category');
	    $specific_product = Request::input('specific_product');
	    $products_id=array();
	    $category_id=array();
	    $rol_id=array();
	    $customer_id=array();
	    $specific_category_id=array();
	    $specific_product_id=array();
	    foreach((array)$product_list as $val)
	    {
			$products_id[]=$val['id'];
	    }
	    foreach((array)$category_list as $val)
	    {
			$category_id[]=$val['id'];
	    }
	    foreach((array)$category_list as $val)
	    {
			$category_id[]=$val['id'];
	    }
	    foreach((array)$role_list as $val)
	    {
			$rol_id[]=$val['id'];
	    }
	    foreach((array)$customer_list as $val)
	    {
			$customer_id[]=$val['id'];
	    }
	    foreach((array)$specific_category as $val)
	    {
			$specific_category_id[]=$val['id'];
	    }
	    foreach((array)$specific_product as $val)
	    {
			$specific_product_id[]=$val['id'];
	    }
	    
	    $pro = SpecialOffer::find(Request::input('id'));
	    $pro->offer_name=Request::input('rule_name');
	    $pro->method=Request::input('method');
				    $pro->quantity_based_on=Request::input('quantity_based_on');
				    $pro->condition_match=Request::input('condition_match');
				    $pro->start_date=Request::input('from_date');
				    $pro->end_date=Request::input('end_date');
				    $pro->apply_to=Request::input('apply_to');
				    $pro->product_list=implode(',',$products_id);
				    
				    $pro->customers=Request::input('customers');
				    $pro->category_list=implode(',',$category_id);
				    $pro->role_list=implode(',',$rol_id);
				    $pro->customer_list=implode(',',$customer_id);
				    $pro->amount_purchase=Request::input('amount_purchase');
				    $pro->products_adujst=Request::input('products_adujst');
				    $pro->specific_category=implode(',',$specific_category_id);
				    $pro->specific_product=implode(',',$specific_product_id);
				    $pro->amount_adjust=Request::input('amount_adjust');
				    $pro->adjustment_type=Request::input('adjustment_type');
				    $pro->adjustment_value=Request::input('adjustment_value');
		  $pro->save();
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
			 $path = asset('local/storage/app/');
			\Storage::put('uploads/'.$fileName, $img->encode());
			return "<a ><img src='".$path."/uploads/".$fileName."'  width='128' height='128></a>";
		}
		else
		{
			return $data;
		}
	}
	
	public function getUser()
	{
	    $string = Request::input('keyWord');
	    //$first = DB::table('newsletters')->select('id','name')->where('name','LIKE','%'.$string.'%')->Where('email','LIKE','%'.$string.'%');
	    //$result= DB::table('users')->select('id','CONCAT("fname"," ","lname" ) as name')->where('fname','LIKE','%'.$string.'%')->orWhere('lname','LIKE','%'.$string.'%')->where('status','=','Active')->where('is_delete','=','0')->union($first)->get();
	    //$result = DB::select("select id,CONCAT(fname,' ',lname ) as name from users where (fname LIKE '%".$string."%' or lname LIKE '%".$string."%') and status='Active' and is_delete=0 UNION select id,name from newsletters where (name LIKE '%".$string."' or email LIKE '".$string."') and subscribe =1");
	    $result = DB::select("select id,CONCAT(fname,' ',lname ) as name from users where (fname LIKE '%".$string."%' or lname LIKE '%".$string."%') and status='Active' and is_delete=0");
	    //print_r($result);
	    if($result)
	    {
			foreach($result as $val)
			{
				    if(!empty($val->id))
				    {
						$data[] = $val;
				    }
			}
			
			return array_filter($data);
	    }
	    else 
	    
	    {
			$list[]='error';
			$list[]='No records found.';
			return $list;
	    }
	    
	}
	public function getRole()
	{
	    $string = Request::input('keyWord');
	    $result = DB::table('role')->get();
	    if($result)
	    {
		return array_filter($result);
	    }
	    else 
	    
	    {
			$list[]='error';
			$list[]='No records found.';
			return $list;
	    }
	}
       
 }
 
?>