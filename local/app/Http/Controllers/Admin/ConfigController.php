<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Config; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class ConfigController extends Controller
{      
         public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
              
             return view('admin/config')->with('title','Configuration')->with('subtitle','List');
		
	}      
        public function all(){ 
             $configs = DB::table('configs')->get();  
             return $configs;
		
	}  
	public function edit(){
	
	 $configs= DB::table('configs')->get();           
	 return  $configs;
	     
	}
         public function update(){
             
	  
          $arr=array();
          $all_data=Request::all();  
          $error='';
          foreach($all_data['all_data'] as $key=>$val)
          {
             if(($val['value']=='') || ($val['value']==false) )
             {
                 $error="Error";
             }
             
          }
        
        if ($error=="Error") {
                        $list[]='error';
                        $msg="All fields shoud be filled";
			$list[]=$msg;
			return $list;
        }
	
         foreach($all_data['all_data'] as $ke=>$va){
              
                   $conf = Config::find($va['id']);
                   $conf->value = $va['value'];            
                   $conf->save(); 
              
         }	 
                       $list[]='success';
                       $list[]='Record is updated successfully.';	 
                       return $list;
	     
	}
       
 }
 
?>