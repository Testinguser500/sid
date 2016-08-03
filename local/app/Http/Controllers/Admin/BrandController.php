<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Brand; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class BrandController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $brands = DB::table('brands')->where('is_delete', '=','0')->get();  
             return view('admin/brand')->with('brands',$brands)->with('title','Brands')->with('subtitle','List');
		
	}
       public function add(){ 
             
            
             return view('admin/add_brand')->with('title','Brands')->with('subtitle','Add');	
	}
	public function all(){ 
             $brand = DB::table('brands')->where('is_delete','=','0')->get();  
             return  $brand;
			 
	}
        public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'brand_name' => 'required|soft_unique_single:brands,brand_name',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keyword'=>'required',
	    'image'=>'required',
            'description'=>'required',            
            
        ]);
         
        if ($validator->fails()) {
				$list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
		 
         $destinationPath = 'uploads'; // upload path
         Brand::create(['image' =>'brand/'.Request::input('image'),'meta_title' =>Request::input('meta_title'),'meta_description' =>Request::input('meta_description'),'meta_keyword' =>Request::input('meta_keyword'),'brand_name' =>Request::input('brand_name'),'description' =>Request::input('description'),'is_delete'=>'0','status' =>Request::input('status'),'user_id'=>Auth::user()->id]);  
		  
         $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;
	   
	}
        public function delete(Request $request){
	
	   $chk_id=Request::input('del_id');
           $brand = Brand::find($chk_id);
           $brand->is_delete = '1';
           $brand->save(); 	  		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
			return $list;
	    
	}
        
	 public function edit($id){
	
		$brands= DB::table('brands')->where('id', '=',$id)->first();	
		$return['brands']=$brands;		
		return $return; 
	     
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'brand_name' => 'required',	    
            'description'=>'required',        
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
         //$destinationPath = 'uploads'; // upload path
         //$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = Request::input('image'); // renameing image
         //Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $brand = Brand::find(Request::input('id'));
         $brand->brand_name = Request::input('brand_name');
         if((isset($fileName)) && ($fileName!='')){
	 $brand->image = 'brand/'.$fileName;
         }
         $brand->meta_title =Request::input('meta_title');
         $brand->meta_description =Request::input('meta_description');
         $brand->meta_keyword =Request::input('meta_keyword');
	 $brand->description =Request::input('description');	 
         $brand->status=Request::input('status');
         $brand->save(); 
		  
         $list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	     
	}
       
 }
 
?>