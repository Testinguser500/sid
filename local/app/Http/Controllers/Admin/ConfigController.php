<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Config; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class ConfigController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $configs = DB::table('configs')->get();  
             return view('admin/config')->with('configs',$configs)->with('title','Configuration')->with('subtitle','List');
		
	}      
        
	public function edit(){
	
	 $configs= DB::table('configs')->get();           
	 return view('admin/edit_config')->with('configs',$configs)->with('title','Configuration')->with('subtitle','Edit');
	     
	}
         public function update(Request $request){
             
	  $configs= DB::table('configs')->get(); 
          $arr=array();
          foreach($configs as $val)
          {
            $arr['key_'.$val->id] = 'required' ;
          }
         
	  $validator = Validator::make($request->all(),
           $arr
        );
         
        if ($validator->fails()) {
            return redirect('/admin/config/edit/')
                        ->withErrors($validator)
                        ->withInput();
        }
	
         foreach($request->all() as $ke=>$va){
                $up=explode('key_',$ke);
                if(isset($up[1])){
                    $conf = Config::find($up[1]);
                    $conf->value = $va;            
                    $conf->save(); 
                }
         }	 
         return redirect('/admin/config')->withFlash_message('Record updated Successfully.');
	     
	}
       
 }
 
?>