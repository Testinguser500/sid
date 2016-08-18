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
        public function add(){ 
             $category  = self::getcataegorywithSub();
             return  $category;
	}
        public function attribues(){
           // print_r(Request::all());
            $vald = array();
            $set_val = array();
            $val=Request::input('values');
            foreach($val as $k1 => $v1){
                if($v1['opt_id'] != ''){
                   foreach($v1['attribute'] as $k2 => $v2){
                       $vald['values.'.$k1.'.attribute.'.$k2.'.atr_name']='required|soft_composite_unique:pro_option,option_name,parent_id='.$v1['opt_id'] ;
                       $k2plus=$k2+1;
                       $name=$v1['opt_name'].' attribute '.$k2plus;
                       $set_val['values.'.$k1.'.attribute.'.$k2.'.atr_name']=$name;                      
                          foreach($v2['atr_val'] as $k3 => $v3){
                              $vald['values.'.$k1.'.attribute.'.$k2.'.atr_val.'.$k3.'.val_name']='required' ;
                              $k3plus=$k3+1;
                              $name=$v1['opt_name'].' attribute '.$k2plus.' option '.$k3plus;
                              $set_val['values.'.$k1.'.attribute.'.$k2.'.atr_val.'.$k3.'.val_name']=$name;  
                          } 
                      
                   }  
                }
            }
             $validator = Validator::make(Request::all(), $vald);
             $validator->setAttributeNames($set_val);
             if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
            }
            foreach($val as $k1 => $v1){
                if($v1['opt_id'] != ''){
                   foreach($v1['attribute'] as $k2 => $v2){
                       $opts = Option::create(['option_name' =>$v2['atr_name'],'user_id'=>Auth::user()->id,'type'=>$v2['atr_type'],'status' =>'Active','parent_id' => $v1['opt_id'] ]);  
                      
                          foreach($v2['atr_val'] as $k3 => $v3){
                           $option_val = Option::create(['option_name' =>$v3['val_name'],'user_id'=>Auth::user()->id,'status' =>'Active','parent_id' => $opts->id ]);  
                          } 
                      
                   }  
                }
            }   
           $list[]='success';
           $list[]='Record is added successfully.';	 
	   return $list;	
        }
        public function store(){ 
	   $validator = Validator::make(Request::all(), [
            'option_name' => 'required|soft_unique:pro_option,option_name'  ,
            'category'  =>   'min:1' 
        ]);
          
        if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
        }
        $cat_ids='';
	foreach(Request::input('category') as $ky => $ve){
             if($ve != '')
             {
                if($cat_ids != '')
                {
                    $cat_ids .= ',';
                }                    
               $cat_ids .= $ky;
             }
         }      
	 $opts = Option::create(['option_name' =>Request::input('option_name'),'user_id'=>Auth::user()->id,'status' =>Request::input('status'),'categorys_id' =>$cat_ids]);  
		  
         $list[]='success';
         $list[]=$opts;	 
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
        public function getcataegorywithSub($pid=0)
	{
		$categories = array();
		$result = DB::table('categorys')->where('is_delete', '=','0')->where('parent_id','=',$pid)->get();
		foreach((array)$result as $key=>$mainCategory)
		{
			$category = array();
			 $category['id'] = $mainCategory->id;
			$category['name'] = $mainCategory->category_name;
			$category['parent_id'] = $mainCategory->parent_id;
			$mainCategory->all_category = self::getcataegorywithSub($category['id']);
			$categories[$mainCategory->id] = $category;		
			
		}
		
		return $result;
	}
       
 }
 
?>