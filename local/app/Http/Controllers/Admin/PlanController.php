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
              
             return view('admin/plan')->with('title','Subscription Plan')->with('subtitle','List');
		
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
	
	 $cate= DB::table('categorys')->where('id', '=',$id)->first();  
         $category = DB::table('categorys')->where('is_delete', '=','0')->get();  
         $return['category']=$cate;
         $return['all_cat']=$category;
	 return $return;
	     
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'category_name' => 'required|soft_unique_single:categorys,category_name,'.Request::input('id'),	    
            'description'=>'required',        
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keyword'=>'required',
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
//	 if(Input::file('image')!=''){	 
//         $destinationPath = 'uploads'; // upload path
//         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
//         $fileName = rand(11111,99999).'.'.$extension; // renameing image
//         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
//         }
//         echo Input::file('image');echo'hello';
         $cat = Category::find(Request::input('id'));
         $cat->category_name = Request::input('category_name');
         if((Request::input('image'))){
	 $cat->image = 'category/'.Request::input('image');
         }
	 $cat->description =Request::input('description');
	 $cat->parent_id=Request::input('parent_id');
         $cat->status=Request::input('status');
         $cat->meta_title=Request::input('meta_title');
         $cat->meta_description=Request::input('meta_description');
         $cat->meta_keyword=Request::input('meta_keyword');
         $cat->save(); 
		  
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	     
	}
	
	
	
       
 }
 
?>