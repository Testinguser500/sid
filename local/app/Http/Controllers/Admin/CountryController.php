<?php namespace App\Http\Controllers\Admin;
use App\Country; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class CountryController extends Controller
{

	public function __construct()
		{
			$this->middleware('auth');
			

		}
	
	public function index(){ 
             $user = DB::table('country')->where('is_delete','=',0)->get();  
             return view('admin/country')->with('country_data',$user)->with('title','Static Content')->with('subtitle','List');
		
	}
	
	public function all(){ 
             $data = DB::table('country')->where('is_delete','=',0)->where('pid','=',0)->get(); 
				foreach((array)$data as $key=>$val)
				{
					$state = DB::table('country')->where('is_delete','=',0)->where('pid','=',$val->id)->get();
					//print_r($state);
					$data[$key]->state = $state;
					foreach((array)$state as $i=>$st)
					{
						$city = DB::table('country')->where('is_delete','=',0)->where('pid','=',$st->id)->get();
						$state[$i]->city = $city;
					}
					
				}
             return  $data;
	}
	
	public function getState()
	{
		$pid = Request::input('store_country');
		if($pid)
		{
		$state = DB::table('country')->where('is_delete','=',0)->where('pid','=',$pid)->get();
		return $state;
		}
	}
	public function getCity()
	{
		$pid = Request::input('store_country');
		if($pid)
		{
		$city = DB::table('country')->where('is_delete','=',0)->where('pid','=',$pid)->get();
		return $city;
		}
	}
	public function edit($id){
	
	 $country= DB::table('country')->where('id', '=',$id)->first();  
         $country_data = DB::table('country')->where('pid','=',0)->get();  
	 $return['content'] = $country;
	 $return['all_content'] = $country_data;
	 return $return;
	     
	}
     public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'name' => 'required',
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
		 
        
		if(Request::input('country_id'))
		{
			$pid = Request::input('country_id');
		}
		else
		{
			$pid=0;
		}
		
	 Country::create(['name' =>Request::input('name'),'pid'=>$pid]);  
		  
         $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;
	   
	}     
 public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'name' => 'required',        
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
				  return $list;
        }
	 if(Request::input('country_id'))
		{
			$pid = Request::input('country_id');
		}
		else
		{
			$pid=0;
		}
         $cat = Country::find(Request::input('id'));
		 
         $cat->name = Request::input('name');
         
		$cat->pid =$pid;
         
	 
         $cat->save(); 
		  
		$list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	     
	}
	public function delete(){
	
	   $chk_id=Request::input('del_id');	
           $cat = Country::find($chk_id);
           $cat->is_delete = '1';
           $cat->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	    
	}
	
}