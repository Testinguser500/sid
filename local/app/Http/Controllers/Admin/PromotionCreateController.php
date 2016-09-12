<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Promotion;
use App\PromotionAdtext;
use App\Category;
use App\Product;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
use File;
use Response;
class PromotionCreateController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
        public function index(){
            return view('admin/promotion')->with('title','Pramotion');
        }
        public function getcampaign(){
            $campaign = DB::table('promotion_adtext')->select('compaign_name')->get();
            return $campaign;
        }
        
        public function get_promotn(){
           $promotn = DB::table('promotion_adtext')->select('promotion_name')->get();
            return $promotn; 
        }
        
        public function get_camp_preview(){
          $previw=Request::input('prev_rec'); 
          $id_rec=$previw['id'];
          $cat_arr=array();
          $previw_rec =DB::table('promotion_adtext')->where('id', $id_rec)->first();          
          $prod_id=$previw_rec->product_promote;
          $cat_id=$previw_rec->destination_cat;
          $cat_val_arr=explode(",", $cat_id);
          foreach($cat_val_arr as $val){
              $cat_arr[]=DB::table('categorys')->where('id',$val)->first();
          }          
          $prod = DB::table('product')->where('id',$prod_id)->first();          
          $rec=array(              
                'prviw_data'=>$previw_rec,
                 'product'=>$prod,
                 'category'=>$cat_arr 
                  );
          return $rec; 
        }

        public function getpromotion($adtype){
            $promot_all = DB::table('promotion_settings')->whereNotIn('field_name', ['create_package','schedule_status','destination_cat','payment_option','tooltip','seller_selection','placement_pkg'])->where('ad_type',$adtype)->get();
            $create_package = DB::table('promotion_settings')->where('field_name','create_package')->where('status',1)->where('ad_type',$adtype)->get();
            $schedule_status = DB::table('promotion_settings')->where('field_name','schedule_status')->where('ad_type',$adtype)->get();
            $destination_cat = DB::table('promotion_settings')->where('field_name','destination_cat')->where('ad_type',$adtype)->get();            
            $selr_selection = DB::table('promotion_settings')->where('field_name','seller_selection')->where('ad_type',$adtype)->get();
            $placemnt_pakg = DB::table('promotion_settings')->where('field_name','placement_pkg')->where('ad_type',$adtype)->get();
            $tooltip = DB::table('promotion_settings')->where('field_name','tooltip')->where('ad_type',$adtype)->get();
            $categ_name = DB::table('categorys')->where('status','Active')->where('is_delete',0)->get();
            $prod_name = DB::table('product')->where('status','Active')->where('is_delete',0)->get();
            foreach($create_package as $key=>$crt_pack){
               $fild_val=$crt_pack->field_value;               
               $new_array = explode('-',$fild_val);              
               $create_package[$key]->nview=$new_array[0];
               $create_package[$key]->price=$new_array[1];
            }
            
             $promo_seting_rec=array(
                'prom_all'=>$promot_all,
                'create_package'=> $create_package,
                'schedule_status'=>$schedule_status,
                'destination_cat'=>$destination_cat,                
                'seler_select'=>$selr_selection,
                'placemnt_pkg'=>$placemnt_pakg,
                'tooltip'=>$tooltip,
                'category_name'=>$categ_name,
                'product_name'=>$prod_name
            );  
             
            return $promo_seting_rec;  
        }
        
        public function save_promotion_adtext(){
          
            $prom_adtext=Request::input('adtext_data'); 
               $validator = Validator::make(Request::all(), [
               'adtext_data.newcamp' => 'required',	       
               'adtext_data.select_view'=>'required',            
               'adtext_data.schedule'=>'required',
               'adtext_data.ad_type'=>'required'
              
            ]);
               	   $friendly_names = array(
			'adtext_data.newcamp' => 'Campaign Name',
			'adtext_data.select_view' => 'Views per product',
			'adtext_data.schedule' => 'Schedule',
			'adtext_data.ad_type' => 'Ad Type',
			
			
		    );
	$validator->setAttributeNames($friendly_names);
             if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
              }
            
            if (!array_key_exists('id', $prom_adtext)) {
                if($prom_adtext['schedule']==9){
                  $adtext = new PromotionAdtext;
                  $adtext->compaign_name = $prom_adtext['newcamp'];
                  $adtext->view_price = $prom_adtext['select_view'];
                  $adtext->schedule = $prom_adtext['schedule'];
                  $adtext->start_date = $prom_adtext['start_date'];
                  $adtext->end_date = $prom_adtext['end_date'];
                  $adtext->save();  
                  $list[] =  'success';
                  $list[] =  'Record is added successfully.';
                  $list[] =  $adtext->id;
                }else{
                    $adtext = new PromotionAdtext;
                    $adtext->compaign_name = $prom_adtext['newcamp'];
                    $adtext->view_price = $prom_adtext['select_view'];
                    $adtext->schedule = $prom_adtext['schedule'];
                    $adtext->save();
                    $list[] =  'success';
                    $list[] =  'Record is added successfully.';
                    $list[] =  $adtext->id;
                   
                }
            } else{
                $adtext = PromotionAdtext::find($prom_adtext['id']);  
                if($prom_adtext['schedule']==9){                 
                  $adtext->compaign_name = $prom_adtext['newcamp'];
                  $adtext->view_price = $prom_adtext['select_view'];
                  $adtext->schedule = $prom_adtext['schedule'];
                  $adtext->start_date = $prom_adtext['start_date'];
                  $adtext->end_date = $prom_adtext['end_date'];
                  $adtext->save(); 
                  $list[] =  'success';
                  $list[] =  'Record is updated successfully.';
                  $list[] =  $adtext->id;
                 
                }else{                   
                    $adtext->compaign_name = $prom_adtext['newcamp'];
                    $adtext->view_price = $prom_adtext['select_view'];
                    $adtext->schedule = $prom_adtext['schedule'];
                    $adtext->save();
                    $list[] =  'success';
                    $list[] =  'Record is updated successfully.';
                    $list[] =  $adtext->id;
                }
                
            }
            return $list;
        }
        
        public function update_promotion_adtext(){
            $val=Request::input('adtext_data');   
            
               $validator = Validator::make(Request::all(), [
               'adtext_data.newpromot' => 'required',	       
               'adtext_data.product'=>'required',            
               'adtext_data.category'=>'required',
               'adtext_data.add_content'=>'required',
                'adtext_data.add_discrip'=>'required'   
              
            ]);
               	   $friendly_names = array(
			'adtext_data.newpromot' => 'Promotion Name',	       
                        'adtext_data.product'=>'Product Name',            
                        'adtext_data.category'=>'Category Name',
                        'adtext_data.add_content'=>'Content',
                        'adtext_data.add_discrip'=>'Description'  
			
		    );
	$validator->setAttributeNames($friendly_names);
             if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
              }
            
            if(count($val['category'])>0){
                $cat_val="";
                foreach ($val['category'] as $cat){
                    if($cat_val!=''){
                    $cat_val=$cat_val.','.$cat;
                    }else{
                       $cat_val=$cat; 
                    }
                }
            }
            
            $promotion = PromotionAdtext::find($val['id']);            
            $promotion->compaign_name = $val['newcamp'];
            $promotion->view_price = $val['select_view'];
            $promotion->schedule = $val['schedule']; 
            $promotion->start_date = $val['start_date'];
            $promotion->end_date = $val['end_date'];
            $promotion->promotion_name = $val['newpromot']; 
            $promotion->product_promote = $val['product'];     
            $promotion->destination_cat = $cat_val; 
            $promotion->adcontent_title= $val['add_content'];
            $promotion->adcontent_discrip = $val['add_discrip'];             
            $promotion->save();
            $list[] =  'success';
            $list[] =  'Record is updated successfully.';
            $list[] =  $promotion->id;
            return $list;
            
        }
        
        
        
        
}       