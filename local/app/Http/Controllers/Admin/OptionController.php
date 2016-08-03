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
             $options = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=','0')->get();  
             return $options ;
	}
       
        public function store(){
	   $validator = Validator::make(Request::all(), [
            'option_name' => 'required|soft_unique:pro_option,option_name'                   
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
	   $option_records= DB::table('pro_option')->where('parent_id', '=',$chk_id)->where('is_delete', '=','0')->get();
	   if($option_records){
	      foreach($option_records as $k => $v)
	      {
		$subdata = Option::find($v->id);
		$subdata->is_delete = '1';
		$subdata->save(); 
	      }
	   }	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	}
        
	 public function edit($id){
	 $option= DB::table('pro_option')->where('id', '=',$id)->first();
	 $option_values= DB::table('pro_option')->where('parent_id', '=',$id)->where('is_delete', '=','0')->get(); 
         $return['option']=$option;
         $return['values']=$option_values;
         return $return;
	     
	}
         public function update(){
	  $chk_id=Request::input('id');
          $variba=Request::input('option_value');
          $validation['option_name'] ='required|soft_unique:pro_option,option_name,'.Request::input('id');
           foreach($variba as $key=>$value)
	  {
	       if($value['option_name']!=''){
			if (array_key_exists('id',$value))
			 {
	                   $validation['option_value.'.$key.'.option_name'] = 'required|soft_composite_unique:pro_option,option_name,parent_id='.Request::input('id').','.$value['id'];                         
	                          
			 }
			else
			{
                          $validation['option_value.'.$key.'.option_name'] ='required|soft_composite_unique:pro_option,option_name,parent_id='.Request::input('id');      
      
			}
	       }
	    
	  }
	  $validator = Validator::make(Request::all(), $validation);
	    if ($validator->fails()) {
                   $list[]='error';
                   $msg=$validator->errors()->all();
                   $list[]=$msg;
                   //print_r($list);
                  return $list;
             }
             
          $option_values= DB::table('pro_option')->where('parent_id', '=',Request::input('id'))->where('is_delete', '=','0')->get();
	    foreach($option_values as $ky => $ve){
	      $optionData = Option::find($ve->id);	    
	      $optionData->is_delete='1';
	      $optionData->save(); 
	    }
	 
	  foreach($variba as $key=>$value)
	  {
	       if($value['option_name']!=''){
			if (array_key_exists('id',$value))
			 {
	                     $optionData = Option::find($value['id']);
			     $optionData->option_name=$value['option_name'];
			     $optionData->is_delete='0';
			     $optionData->save(); 
			 }
			else
			{
                               
			    Option::create(['option_name' =>$value['option_name'],'parent_id'=>Request::input('id'),'user_id'=>Auth::user()->id,'status' =>'Active']);  
			}
	       }
	    
	  }
	    $list[]='success';
	    $list[]='Record is updated successfully.';	 
	    return $list;    
	}
       
 }
 
?>