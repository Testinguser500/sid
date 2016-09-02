<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Promotion;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
use File;
use Response;
class PromotionSettingController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
        public function index(){
            return view('admin/promotion_setting')->with('title','Promotion Setting');
        }
        public function update_setting(){ 
            
           DB::table('promotion_settings')
            ->where('ad_type', 'text_ad')
            ->where('field_name','create_package')       
            ->update(['status' => 0]);
            
            $prom_all=Request::input('setting_data');
            foreach($prom_all['prom_all'] as $key=>$val){ //print_r($val);
            $promotion = Promotion::find($val['id']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = $val['field_value'];
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
           foreach($prom_all['create_package'] as $key=>$val){
               $fldval=$val['nview']."-".$val['price'];
               if( array_key_exists ('id',$val)){
                 $promotion = Promotion::find($val['id']);
                 $promotion->field_name=$val['ad_type'];
                 $promotion->field_name = $val['field_name'];
                 $promotion->field_value = $fldval;
                 $promotion->status = $val['status'];                      
                 $promotion->save();
               }else{
                 $promotion = new Promotion;
                 $promotion->field_name=$val['ad_type'];
                 $promotion->field_name = 'create_package';
                 $promotion->field_value = $fldval;
                 $promotion->status = 1;                      
                 $promotion->save();  
               }
           }
           foreach($prom_all['destination_cat'] as $key=>$val){ //print_r($val);
            $promotion = Promotion::find($val['id']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = $val['field_value'];
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
           foreach($prom_all['payment_opt'] as $key=>$val){ //print_r($val);
            $promotion = Promotion::find($val['id']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = $val['field_value'];
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
           foreach($prom_all['schedule_status'] as $key=>$val){ //print_r($val);
            $promotion = Promotion::find($val['id']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = $val['field_value'];
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
           foreach($prom_all['create_package'] as $key=>$val){// print_r($val);
            $promotion = Promotion::find($val['id']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = $val['field_value'];
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
            foreach($prom_all['tooltip'] as $key=>$val){ //print_r($val);
            $promotion = Promotion::find($val['id']);
            $tol_val=array($val['tool_fd']=>$val['tool_val']);
            $promotion->field_name = $val['field_name'];
            $promotion->field_value = serialize($tol_val);
            $promotion->status = $val['status'];                      
            $promotion->save();
           }
           $return[0]="success";
           $return[1]="Record is updated successfuly";
           return $return;
        }
        public function get_setting($setting){
            $promot_all = DB::table('promotion_settings') ->whereNotIn('field_name', ['create_package','schedule_status','destination_cat','payment_option','tooltip'])->where('ad_type',$setting)->get();
            $create_package = DB::table('promotion_settings')->where('field_name','create_package')->where('status',1)->where('ad_type',$setting)->get();
            $schedule_status = DB::table('promotion_settings')->where('field_name','schedule_status')->where('ad_type',$setting)->get();
            $destination_cat = DB::table('promotion_settings')->where('field_name','destination_cat')->where('ad_type',$setting)->get();
            $tooltip = DB::table('promotion_settings')->where('field_name','tooltip')->where('ad_type',$setting)->get();
            foreach($tooltip as $key=>$val)
            {
                $data=unserialize($val->field_value);
                foreach($data as $k=>$v){
                    $tooltip[$key]->tool_fd=$k;
                    $tooltip[$key]->tool_val=$v;
                }
           
            }
            foreach($create_package as $key=>$crt_pack){
               $fild_val=$crt_pack->field_value;
               $new_array = explode('-',$fild_val);              
               $create_package[$key]->nview=$new_array[0];
               $create_package[$key]->price=$new_array[1];
            }
            
            $payment_opt = DB::table('promotion_settings')->where('field_name','payment_option')->where('ad_type','text_ad')->get();
            $promot_setting=array(
                'prom_all'=>$promot_all,
                'create_package'=> $create_package,
                'schedule_status'=>$schedule_status,
                'destination_cat'=>$destination_cat,
                'tooltip'=>$tooltip,
                'payment_opt'=>$payment_opt
            );
            return $promot_setting;
        }
        
}

