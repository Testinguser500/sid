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
             $attr_gr = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=','0')->get(); 
             foreach($attr_gr as $key=>$val)
             {
                 $cats_name='';
                 if($val->categorys_id != ''){
                     $cats_id=explode(',',$val->categorys_id);
                     foreach($cats_id as $ct)
                     {
                          $cats_res = DB::table('categorys')->where('is_delete', '=','0')->where('id', '=',$ct)->first();
                          if($cats_name != ''){
                              $cats_name .=',';
                          }
                          $cats_name .= $cats_res->category_name;
                     }
                     $attr_gr[$key]->category_name = $cats_name;  
                 }
                $attr = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',$val->id)->get(); 
                $attr_gr[$key]->attribute = $attr;
                if( count($attr_gr[$key]->attribute) > 0 ){
                    foreach($attr_gr[$key]->attribute as $key1=>$val1)
                    {
                      $opt = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',$val1->id)->get();  
                      $attr_gr[$key]->attribute[$key1]->options = $opt;
                    }
                }
             }
             $check_cats=DB::table('categorys')->select('id')->where('is_delete', '=','0')->get();
             $return['category']  = self::getcataegorywithSub();
             $return['only_cat_id']  = $check_cats; 
             $return['attr_gr']=$attr_gr;
             return $return ;
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
                       $opts = Option::create(['option_name' =>$v2['atr_name'],'user_id'=>Auth::user()->id,'type'=>$v2['atr_type'],'status' =>'Active','parent_id' => $v1['opt_id'] ,'allow' => $v2['allow'] ]);  
                      
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
            $ids=Request::input('del_ids');            
            $filtered_ary=array_filter($ids);
            foreach($filtered_ary as $key => $val){
                $data = Option::find($key);
                $data->is_delete = '1';
                $data->save(); 
                $option_records= DB::table('pro_option')->where('parent_id', '=',$key)->where('is_delete', '=','0')->get();
                if(count($option_records)>0){
                    foreach($option_records as $k => $v)
                    {                      
                       $subdata = Option::find($v->id);
                       $subdata->is_delete = '1';
                       $subdata->save(); 
                       $option_val = DB::table('pro_option')->where('parent_id', '=',$v->id)->where('is_delete', '=','0')->get();
                       if(count($option_val)>0) 
                       foreach($option_val as $k1 => $v1)
                       {  
                            $subdata1 = Option::find($v1->id);
                            $subdata1->is_delete = '1';
                            $subdata1->save(); 
                       
                       }
                    }
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
        //  print_r(Request::input('update_values'));
          $upd_val= Request::input('update_values');
          $validation['update_values.option_name'] ='required|soft_unique:pro_option,option_name,'.$upd_val['id'];
          $set_val['update_values.option_name']="Attribute Group";
          
          $validation['update_values.categorys_id'] ='required';
          $set_val['update_values.categorys_id']="Categorys";
         
          if(count($upd_val['attribute'])>0){
              foreach($upd_val['attribute'] as $key => $val)
              {    
                   if(array_key_exists('id',$val)){
                   $validation['update_values.attribute.'.$key.'.option_name'] ='required|soft_composite_unique:pro_option,option_name,parent_id='.$upd_val['id'].','.$val['id'];
                   }else{
                   $validation['update_values.attribute.'.$key.'.option_name'] ='required|soft_composite_unique:pro_option,option_name,parent_id='.$upd_val['id'];    
                   }
                   $keyplus=$key+1;
                   $name=$upd_val['option_name'].' attribute '.$keyplus;
                   $set_val['update_values.attribute.'.$key.'.option_name']=$name;
                   if(count($val['options'])>0){
                       foreach($val['options'] as $key1 => $val1)
                       {
                        if(array_key_exists('id',$val1)){
                        $validation['update_values.attribute.'.$key.'.options.'.$key1.'.option_name'] ='required|soft_composite_unique:pro_option,option_name,parent_id='.$val['id'].','.$val1['id'];
                        }else{
                        if(array_key_exists('id',$val)){
                         $validation['update_values.attribute.'.$key.'.options.'.$key1.'.option_name'] ='required|soft_composite_unique:pro_option,option_name,parent_id='.$val['id'];     
                        }else{
                          $validation['update_values.attribute.'.$key.'.options.'.$key1.'.option_name'] ='required'; 
                        }
                            
                          
                        }
                        $key1plus=$key1+1;
                        $name=$upd_val['option_name'].' attribute '.$keyplus.' option '.$key1plus;
                        $set_val['update_values.attribute.'.$key.'.options.'.$key1.'.option_name']=$name;  
                       }
                   }
              }
          }
             $validator = Validator::make(Request::all(), $validation);
             $validator->setAttributeNames($set_val);
             if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
             }
            $attr_grp = Option::find($upd_val['id']);	    
            $attr_grp->option_name=$upd_val['option_name'];  
            $attr_grp->categorys_id=$upd_val['categorys_id']; 
            $attr_grp->status=$upd_val['status'];             
            $attr_grp->save(); 
            $all_attri=DB::table('pro_option')->where('parent_id', '=',$upd_val['id'])->where('is_delete', '=','0')->get();
            foreach($all_attri as $atr_val)
            {
                 $attrData = Option::find($atr_val->id);	    
	         $attrData->is_delete='1';   
                 $attrData->save(); 
                 $all_opts=DB::table('pro_option')->where('parent_id', '=',$atr_val->id)->where('is_delete', '=','0')->get();
                 foreach($all_opts as $opt_val)
                 {
                         $optData = Option::find($opt_val->id);	    
                         $optData->is_delete='1';   
                         $optData->save();                         

                 }
            }
            if(count($upd_val['attribute'])>0){
              foreach($upd_val['attribute'] as $key => $val)
              {    
                   if(array_key_exists('id',$val)){
                        $attr = Option::find($val['id']);	    
                        $attr->option_name=$val['option_name'];  
                        $attr->type=$val['type']; 
                        $attr->allow=$val['allow']; 
                        $attr->is_delete=0; 
                        $attr->save(); 
                   }else{
                        $attr = Option::create(['option_name' =>$val['option_name'],'user_id'=>Auth::user()->id,'type'=>$val['type'],'status' =>'Active','parent_id' => $upd_val['id'],'allow' => $val['allow'] ]); 
                        
                   }                  
                   if(count($val['options'])>0){
                       foreach($val['options'] as $key1 => $val1)
                       {
                        if(array_key_exists('id',$val1)){
                            $opt = Option::find($val1['id']);	    
                            $opt->option_name=$val1['option_name'];                             
                            $opt->is_delete=0; 
                            $opt->save(); 
                        }else{
                            $opt = Option::create(['option_name' =>$val1['option_name'],'user_id'=>Auth::user()->id,'status' =>'Active','parent_id' => $attr->id ]);    
                        }
                          
                       }
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