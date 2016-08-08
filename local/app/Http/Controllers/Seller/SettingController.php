<?php namespace App\Http\Controllers\Seller;
use App\User;
use App\Store;
use DB;
use Crypt;
use Auth;
use Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\cart\Cart;
use Session;
use Request;
use Image;
use File;
class SettingController extends Controller
{
	public function index(){   
             
                
        return view('seller/setting')->with('title','Store Setting')->with('subtitle','Setting'); 
             		  
	}
        
	public function all(){ 
        $store_data = DB::table('store')->where('user_id','=',Auth::user()->id)->first();
	$country = DB::table('country')->where('pid','=','0')->where('is_delete','=','0')->get();
	$return['store_data'] = $store_data;
	$return['country'] = $country;
        return  $return;
			 
	}
	
	public function update()
	{
		
		$validation = array(
		'store_name'=>'required',
		'store_link'=>'required',
		'store_country'=>'required',
		'store_state'=>'required',
		'store_city'=>'required',
		'store_address'=>'required',
		'store_phone'=>'required'
		);
		
		$validator = Validator::make(Request::all(), $validation);
		if ($validator->fails()) {
				$list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
			}
	$store = Store::find(Request::input('store_id'));
		$store->store_name = Request::input('store_name');
		if(Request::input('banner'))
		$store->banner = Request::input('banner');
		if(Request::input('logo'))
		$store->logo = Request::input('logo');
	
		$store->store_country = Request::input('store_country');
		$store->store_state = Request::input('store_state');
		$store->store_city = Request::input('store_city');
		$store->store_address = Request::input('store_address');
		$store->phone = Request::input('store_phone');
		$store->save();
			
		$list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	}
 }
 
?>