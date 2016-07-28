<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Option; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class OptionController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
            
             return view('admin/option')->with('title','Option')->with('subtitle','List');
		
	}
        public function all(){ 
             $options = DB::table('pro_option')->where('is_delete', '=','0')->get();  
             return $options ;
	}
       
        public function store(){
	   $validator = Validator::make(Request::all(), [
            'option_name' => 'required'                   
        ]);
         
        if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
        }
	       
	 Option::create(['option_name' =>Request::input('option_name'),'user_id'=>Auth::user()->id,'status' =>Request::input('status')]);  
		  
         $list[]='success';
         $list[]='Record is added successfully.';	 
	 return $list;
	   
	}
        public function delete(){
	   $chk_id=Request::input('del_id');	
           $data = Option::find($chk_id);
           $data->is_delete = '1';
           $data->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	}
        
	 public function edit($id){
	 $option= DB::table('pro_option')->where('id', '=',$id)->first(); 
         $return['data']=$option;
         return $return;
	     
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'option_name' => 'required',
	    'option_value'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
                    $list[]='error';
                    $msg=$validator->errors()->all();
                    $list[]=$msg;
                    return $list;
        }
	
         $optionData = Option::find(Request::input('option_id'));
         $optionData->option_name = Request::input('option_name');
         $optionData->option_value =Request::input('option_value');
	 $optionData->status=Request::input('status');
         $optionData->save(); 
		  
         $list[]='success';
         $list[]='Record is updated successfully.';	 
	 return $list;
	     
	}
       
 }
 
?>