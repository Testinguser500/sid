<?php namespace App\Http\Controllers\Admin;
use App\StaticContent; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;

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
	
	public function edit($id){
	
	 $static= DB::table('static_content')->where('id', '=',$id)->first();  
         $static_data = DB::table('static_content')->get();  
	 return view('admin/content_edit')->with('static_data',$static_data)->with('static',$static)->with('title','Content')->with('subtitle','Edit');
	     
	}
         
 public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'title' => 'required',	    
            'description'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/static-content/edit/'.$request->get('content_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
	 if(Input::file('image')!=''){	 
         $destinationPath = 'uploads/static/'; // upload path
         $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = StaticContent::find($request->get('content_id'));
         $cat->title = $request->get('title');
         if((isset($fileName)) && ($fileName!='')){
	 $cat->image = $fileName;
         }
	 $cat->short_description =$request->get('short_description');
         $cat->description =$request->get('description');
	 
         $cat->save(); 
		  
         return redirect('/admin/static-content')->withFlash_message('Record updated Successfully.');
	     
	}
}