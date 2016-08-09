<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Plan; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class PlanController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
              $data = DB::table('plans')->where('is_delete', '=','0')->get(); 
             return view('admin/plan')->with('plans_data',$data)->with('title','Subscription Plan')->with('subtitle','List');
		
	}
        public function all(){ 
             $category = DB::table('plans')->where('is_delete', '=','0')->get();               
             return  $category;
		
	}
       
        public function store(){
	
	   $validator = Validator::make(Request::all(), [
            'plan_name' => 'required',
	    'plan_duration'=>'required|numeric',
	    'plan_price'=>'required|numeric',
            'description'=>'required',            
            'image'=>'required'
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
	
	$cat= Plan::create(['image' => Request::input('image'),'plan_name' =>Request::input('plan_name'),'plan_duration' =>Request::input('plan_duration'),'plan_price' =>Request::input('plan_price'),'description' =>Request::input('description'),'plan_status' =>Request::input('status'),'is_delete'=>'0','user_id'=>Auth::user()->id]);  
	  
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
	
	 $cate= DB::table('plans')->where('id', '=',$id)->first();  
         $category = DB::table('plans')->where('is_delete', '=','0')->get();  
         $return['plan']=$cate;
         $return['all_plan']=$category;
	 return $return;
	     
	}
         public function update(){
	
	//print_r(Request::all());
	  $validator = Validator::make(Request::all(), [
            'plan_name' => 'required',
	    'plan_duration'=>'required|numeric',
	    'plan_price'=>'required|numeric',
            'description'=>'required'            
            
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }

         $cat = Plan::find(Request::input('plan_id'));
         $cat->plan_name = Request::input('plan_name');
         if((Request::input('image'))){
	 $cat->plan_image = Request::input('image');
         }
	 $cat->description =Request::input('description');
	 $cat->plan_duration=Request::input('plan_duration');
         $cat->plan_status=Request::input('plan_status');
         $cat->plan_price=Request::input('plan_price');
         $cat->save(); 
		  
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	     
	}
	
	
	
       
 }
 
?>