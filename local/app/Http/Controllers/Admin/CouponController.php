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
	
	   $validator = Validator::make(Request::all(), [
            'coupon_name' => 'required',
	    'discount_type'=>'required',
	    'discount_value'=>'required|numeric',
            'description'=>'required',            
            'usage_limit'=>'required|numeric',
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
			      'products' =>implode(',',Request::input('products')),
			      'exclude_products' =>implode(',',Request::input('exclude_products')),
			      'category' =>implode(',',Request::input('category')),
			      'exclude_category' =>implode(',',Request::input('exclude_category')),
			      'user_email' =>implode(',',Request::input('user_email')),
			      
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
	
	 $cate= DB::table('coupons')->where('id', '=',$id)->first();  
         $category = DB::table('coupons')->where('is_delete', '=','0')->get();  
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
            'usage_limit'=>'required|numeric',
	    'expire_date'=>'required',
	    'min_amount'=>'required|numeric',          
            
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }

         $cat = Coupon::find(Request::input('coupon_id'));
         $cat->coupon_name = Request::input('coupon_name');
        $cat->discount_type = Request::input('discount_type');
	 $cat->description =Request::input('description');
	 $cat->discount_value=Request::input('discount_value');
         $cat->usage_limit=Request::input('usage_limit');
         $cat->expire_date=Request::input('expire_date');
	 $cat->exclude_sale=Request::input('exclude_sale');
	 $cat->min_amount=Request::input('min_amount');
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