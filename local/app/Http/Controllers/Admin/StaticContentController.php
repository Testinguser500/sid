<?php namespace App\Http\Controllers\Admin;
use App\StaticContent; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;

use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class StaticContentController extends Controller
{

	public function __construct()
		{
			$this->middleware('auth');
			

		}
	
	public function index(){ 
             $user = DB::table('static_content')->get();  
             return view('admin/static_content')->with('static_data',$user)->with('title','Static Content')->with('subtitle','List');
		
	}
	
	public function all(){ 
             $data = DB::table('static_content')->get();  
             return  $data;
	}
	
	public function edit($id){
	
	 $static= DB::table('static_content')->where('id', '=',$id)->first();  
         $static_data = DB::table('static_content')->get();  
	 $return['content'] = $static;
	 $return['all_content'] = $static_data;
	 return $return;
	     
	}
         
 public function update(){
	
	  $validator = Validator::make(Request::all(), [
		'title' => 'required',	    
		'description'=>'required',
		'meta_title'=>'required',
		'meta_title'=>'required',
		'meta_description'=>'required',
		'meta_keyword'=>'required',
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
				  return $list;
        }
	 if(Request::input('image')!=''){	 
         //$destinationPath = 'uploads/static/'; // upload path
         //$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = Request::input('image'); // renameing image
         //Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = StaticContent::find(Request::input('id'));
		 
         $cat->title = Request::input('title');
         if((isset($fileName)) && ($fileName!='')){
	 $cat->image = $fileName;
         }
	 $cat->short_description =Request::input('short_description');
         $cat->meta_title =Request::input('meta_title');
	 $cat->meta_description =Request::input('meta_description');
	 $cat->meta_keyword =Request::input('meta_keyword');
         $cat->save(); 
		  
		$list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	     
	}
}