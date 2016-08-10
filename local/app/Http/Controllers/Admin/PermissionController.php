<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Role; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class PermissionController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
              $data = DB::table('role')->get(); 
             return view('admin/permission')->with('role_data',$data)->with('title','Role Permission')->with('subtitle','List');
		
	}
        public function all(){ 
             $category = DB::table('role')->get();
	     foreach($category as $val)
	     {
			$val->setting = json_decode($val->param);
			$setting['site_login_setting'][$val->id]= $val->setting->site_login_setting;
			$setting['admin_login_setting'][$val->id]= $val->setting->admin_login_setting;
			$setting['create_setting'][$val->id]= $val->setting->create_setting;
			$setting['edit_own_setting'][$val->id]= $val->setting->edit_own_setting;
			$setting['edit_setting'][$val->id]= $val->setting->edit_setting;
			$setting['delete_setting'][$val->id]= $val->setting->delete_setting;
			
	     }
	     //print_r($setting);exit;
             $return['roles'] = $category;
	     $return['setting'] = $setting;
	     return $return;
		
	}
       
        public function store(){
	$site_login_setting = Request::input('site_login_setting');
	$admin_login_setting = Request::input('admin_login_setting');
	$create_setting = Request::input('create_setting');
	$edit_setting = Request::input('edit_setting');
	$delete_setting = Request::input('delete_setting');
	$edit_own_setting = Request::input('edit_own_setting');
	
	
	$data = DB::table('role')->get();
	foreach($data as $ro)
	{
	    $result[$ro->id]['site_login_setting'] = $site_login_setting[$ro->id];
	    $result[$ro->id]['admin_login_setting'] = $admin_login_setting[$ro->id];
	    $result[$ro->id]['create_setting'] = $create_setting[$ro->id];
	    $result[$ro->id]['edit_setting'] = $edit_setting[$ro->id];
	    $result[$ro->id]['delete_setting'] = $delete_setting[$ro->id];
	    $result[$ro->id]['edit_own_setting'] = $edit_own_setting[$ro->id];
	}
	//print_r($result);
	   
	foreach($result as $key=>$val)
	{
	     //(json_encode($val));
	    $cat = Role::find($key);
	    $cat->param = json_encode($val);
	    $cat->save();
	}
	
	  
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