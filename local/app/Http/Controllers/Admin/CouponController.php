<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Coupon; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class CouponController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
              $data = DB::table('coupons')->where('is_delete', '=','0')->get(); 
             return view('admin/coupon')->with('coupon_data',$data)->with('title','Coupon')->with('subtitle','List');
		
	}
        public function all(){ 
             $coupon = DB::table('coupons')->where('is_delete', '=','0')->get();
	     $category = DB::table('categorys')->where('is_delete', '=','0')->get();
             $return['category'] = $category;
	     $return['coupon'] = $coupon;
	     return $return;
		
	}
       
        public function store(){
	//print_r(Request::all());
	   $validator = Validator::make(Request::all(), [
            'coupon_name' => 'required',
	    'discount_type'=>'required',
	    'discount_value'=>'required|numeric',
            'description'=>'required',            
            //'usage_limit'=>'required|numeric',
	    'expire_date'=>'required',
	    'products'=>'required',
	    'category'=>'required',
	    'user_email'=>'required',
	    
	    
	    'min_spend'=>'required|numeric',
	    
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
	$products_id='';
	$exproducts_id='';
	$category_id='';
	$excategory_id='';
	$userEmail = '';
	$products = Request::input('products');
	$exproducts = Request::input('exclude_products');
	$category = Request::input('category');
	$excategory = Request::input('exclude_category');
	$user_email = Request::input('user_email');
	foreach($products as $val)
	{
	    $products_id[] = $val['id'];
	}
	foreach($exproducts as $val)
	{
	    $exproducts_id[] = $val['id'];
	}
	foreach($category as $val)
	{
	    $category_id[] = $val['id'];
	}
	foreach($excategory as $val)
	{
	    $excategory_id[] = $val['id'];
	}
	foreach($user_email as $val)
	{
	    $userEmail[] = $val['email'];
	}
	$cat= Coupon::create(['coupon_name' => Request::input('coupon_name'),
			      'discount_type' =>Request::input('discount_type'),
			      'discount_value' =>Request::input('discount_value'),
			      'free_shipp' =>Request::input('free_shipp'),
			      'description' =>Request::input('description'),
			      'usage_limit_coupon' =>Request::input('usage_limit_coupon'),
			      'usage_limit_user' =>Request::input('usage_limit_user'),
			      'min_spend' =>Request::input('min_spend'),
			      'max_spend' =>Request::input('max_spend'),
			      'expire_date' =>Request::input('expire_date'),
			      'exclude_sale' =>Request::input('exclude_sale')?Request::input('exclude_sale'):0,
			      'individual' =>Request::input('individual'),
			      'products' =>implode(',',$products_id),
			      'exclude_products' =>implode(',',$exproducts_id),
			      'category' =>implode(',',$category_id),
			      'exclude_category' =>implode(',',$excategory_id),
			      'user_email' =>implode(',',$userEmail),
			      
			      'coupon_status' =>Request::input('coupon_status'),
			      'is_delete'=>'0','user_id'=>Auth::user()->id]);  
	  
            $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;
	   
	}
        public function delete(Request $request){
	
	   $chk_id=Request::input('del_id');	
           $cat = Category::find($chk_id);
           $cat->is_delete = '1';
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;
	    
	}
        
	 public function edit($id){
	$userEmail='';
	 $cate= DB::table('coupons')->where('id', '=',$id)->first();
	 $pro_id = explode(',',$cate->products);
	 $expro_id = explode(',',$cate->exclude_products);
	 $cat_id = explode(',',$cate->category);
	 $excat_id = explode(',',$cate->exclude_category);
	 $category = DB::table('coupons')->where('is_delete', '=','0')->get();
	 $cate->product_data = DB::table('product')->whereIn('id',$pro_id)->get();
	 $cate->exproduct_data = DB::table('product')->whereIn('id',$expro_id)->get();
	 $cate->category_data = DB::table('categorys')->whereIn('id',$cat_id)->get();
	 $cate->excategory_data = DB::table('categorys')->whereIn('id',$excat_id)->get();
	 $user_email =explode(',',$cate->user_email);
	 foreach((array)$user_email as $val)
	 {
	    $userEmail[]=array('email'=>$val);
	 }
	 $cate->user_email = $userEmail;
         $return['coupon']=$cate;
         $return['all_coupon']=$category;
	 return $return;
	     
	}
         public function update(){
	
	//print_r(Request::all());
	  $validator = Validator::make(Request::all(), [
            'coupon_name' => 'required',
	    'discount_type'=>'required',
	    'discount_value'=>'required|numeric',
            'description'=>'required',            
            //'usage_limit'=>'required|numeric',
	    'expire_date'=>'required',
	    'products'=>'required',
	    'category'=>'required',
	    'user_email'=>'required',
	    'min_spend'=>'required|numeric',          
            
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
	$products_id='';
	$exproducts_id='';
	$category_id='';
	$excategory_id='';
	$userEmail = '';
	$products = Request::input('products');
	$exproducts = Request::input('exclude_products');
	$category = Request::input('category');
	$excategory = Request::input('exclude_category');
	$user_email = Request::input('user_email');
	foreach($products as $val)
	{
	    $products_id[] = $val['id'];
	}
	foreach($exproducts as $val)
	{
	    $exproducts_id[] = $val['id'];
	}
	foreach($category as $val)
	{
	    $category_id[] = $val['id'];
	}
	foreach($excategory as $val)
	{
	    $excategory_id[] = $val['id'];
	}
	foreach($user_email as $val)
	{
	    $userEmail[] = $val['email'];
	}

         $cat = Coupon::find(Request::input('coupon_id'));
         $cat->coupon_name = Request::input('coupon_name');
        $cat->discount_type = Request::input('discount_type');
	 $cat->description =Request::input('description');
	 $cat->discount_value=Request::input('discount_value');
	 $cat->free_shipp=Request::input('free_shipp');
	 
         $cat->usage_limit_coupon=Request::input('usage_limit_coupon');
	 $cat->usage_limit_user=Request::input('usage_limit_user');
         $cat->expire_date=Request::input('expire_date');
	 $cat->exclude_sale=Request::input('exclude_sale');
	 $cat->min_spend=Request::input('min_spend');
	 $cat->max_spend=Request::input('max_spend');
	 $cat->individual=Request::input('individual');
	 $cat->products =implode(',',$products_id);
	$cat->exclude_products =implode(',',$exproducts_id);
	    $cat->category =implode(',',$category_id);
	    $cat->exclude_category =implode(',',$excategory_id);
	    $cat->user_email =implode(',',$userEmail);
			      
	 $cat->coupon_status=Request::input('coupon_status');
         $cat->save(); 
		  
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	     
	}
	
	public function deletecoupon()
	{
	    $chk_id=Request::input('del_id');
	    $data = Coupon::find($chk_id);
	    $data->is_delete = '1';
	    $data->save(); 	   		 
	    $list[]='success';
	    $list[]='Record is deleted successfully.';	 
	    return $list;
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
		
		$cat = Coupon::find($id);
           $cat->coupon_status = $status;
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='Coupon status has been changed successfully.';	 
	   return $list;
	}
	
	public function getProduct()
	{
	    $string = Request::input('keyWord');
	    if($string)
	    {
	    $result= DB::table('product')->where('pro_name','LIKE','%'.$string.'%')->where('status','=','Active')->where('is_delete','=','0')->get();
	    if($result)
	    {
			return $result;
	    }
	    else 
	    
	    {
			$list[]='error';
			$list[]='No records found.';
			return $list;
	    }
	    }
	}
	public function getCategory()
	{
	    $string = Request::input('keyWord');
	    
	    $result= DB::table('categorys')->where('category_name','LIKE','%'.$string.'%')->where('status','=','Active')->where('is_delete','=','0')->get();
	    if($result)
	    {
			return $result;
	    }
	    else 
	    
	    {
			$list[]='error';
			$list[]='No records found.';
			return $list;
	    }
	    
	}
	
	public function getUser()
	{
	    $string = Request::input('keyWord');
	    $first = DB::table('newsletters')->select('email')->where('name','LIKE','%'.$string.'%')->Where('email','LIKE','%'.$string.'%');
	    $result= DB::table('users')->select('email')->where('fname','LIKE','%'.$string.'%')->orWhere('lname','LIKE','%'.$string.'%')->where('status','=','Active')->where('is_delete','=','0')->union($first)->get();
	    
	    if($result)
	    {
			foreach($result as $val)
			{
				    if(!empty($val->email))
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
	
	
       
 }
 
?>