<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Category; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;

use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class CategoryController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $category = DB::table('categorys')->where('is_delete', '=','0')->get();  
             return view('admin/category')->with('categories',$category)->with('title','Category')->with('subtitle','List');
		
	}
       public function add(){ 
             
             $category = DB::table('categorys')->where('is_delete', '=','0')->get();  
             return view('admin/add_category')->with('categories',$category)->with('title','Category')->with('subtitle','Add');	
	}
        public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'name' => 'required',
	        'image'=>'required',
            'description'=>'required',            
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/category/add')
                        ->withErrors($validator)
                        ->withInput();
        }
		 
         $destinationPath = 'uploads'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
	 Category::create(['image' =>$fileName,'category_name' =>$request->get('name'),'description' =>$request->get('description'),'status' =>$request->get('status'),'parent_id'=>$request->get('parent_cat'),'is_delete'=>'0','user_id'=>Auth::user()->id]);  
		  
         return redirect('/admin/category')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	
           $cat = Category::find($chk_id);
           $cat->is_delete = '1';
           $cat->save(); 	   		 
           return  redirect('/admin/category')->withFlash_message('Record Deleted  Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $cate= DB::table('categorys')->where('id', '=',$id)->first();  
         $category = DB::table('categorys')->where('is_delete', '=','0')->get();  
	 return view('admin/edit_category')->with('categories',$category)->with('categ',$cate)->with('title','Category')->with('subtitle','Edit');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'name' => 'required',	    
            'description'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/category/edit/'.$request->get('category_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
	 if(Input::file('image')!=''){	 
         $destinationPath = 'uploads'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = Category::find($request->get('category_id'));
         $cat->category_name = $request->get('name');
         if((isset($fileName)) && ($fileName!='')){
	 $cat->image = $fileName;
         }
	 $cat->description =$request->get('description');
	 $cat->parent_id=$request->get('parent_cat');
         $cat->status=$request->get('status');
         $cat->save(); 
		  
         return redirect('/admin/category')->withFlash_message('Record updated Successfully.');
	     
	}
       
 }
 
?>