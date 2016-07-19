<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Brand; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
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
        public function store(Request $request){
	
  
	   $validator = Validator::make($request->all(), [
            'name' => 'required',
	    'image'=>'required',
            'description'=>'required',            
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/brand/add')
                        ->withErrors($validator)
                        ->withInput();
        }
		 
         $destinationPath = 'uploads'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
	 Brand::create(['image' =>$fileName,'brand_name' =>$request->get('name'),'description' =>$request->get('description'),'is_delete'=>'0','status' =>$request->get('status'),'user_id'=>Auth::user()->id]);  
		  
         return redirect('/admin/brand')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');
           $brand = Brand::find($chk_id);
           $brand->is_delete = '1';
           $brand->save(); 	  		 
           return  redirect('/admin/brand')->withFlash_message('Record Deleted Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $brands= DB::table('brands')->where('id', '=',$id)->first();  
         
	 return view('admin/edit_brand')->with('brand',$brands)->with('title','Brands')->with('subtitle','Edit');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'name' => 'required',	    
            'description'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/brand/edit/'.$request->get('brand_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
	 if(Input::file('image')!=''){	 
         $destinationPath = 'uploads'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $brand = Brand::find($request->get('brand_id'));
         $brand->brand_name = $request->get('name');
         if((isset($fileName)) && ($fileName!='')){
	 $brand->image = $fileName;
         }
	 $brand->description =$request->get('description');	 
         $brand->status=$request->get('status');
         $brand->save(); 
		  
         return redirect('/admin/brand')->withFlash_message('Record updated Successfully.');
	     
	}
       
 }
 
?>