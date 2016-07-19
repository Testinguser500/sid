<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Faq; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class FaqController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $faqs = DB::table('faqs')->get();  
             return view('admin/faqs')->with('faqs',$faqs)->with('title','Faq')->with('subtitle','List');
		
	}
       public function add(){              
             
             return view('admin/add_faq')->with('title','Faq')->with('subtitle','Add Questions Answer');	
	}
        public function store(Request $request){
	
  
	   $validator = Validator::make($request->all(), [
            'question' => 'required',
	    'answer'=>'required',                    
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/faq/add')
                        ->withErrors($validator)
                        ->withInput();
        }
	       
	 Faq::create(['quest' =>$request->get('question'),'ans' =>$request->get('answer'),'status' =>$request->get('status')]);  
		  
         return redirect('/admin/faq')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	
           DB::table('faqs')->where('id', '=',$chk_id)->delete();    		 
           return  redirect('/admin/faq')->withFlash_message('Record Deleted Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $faq= DB::table('faqs')->where('id', '=',$id)->first();  
         
	 return view('admin/edit_faq')->with('faq',$faq)->with('title','Faq')->with('subtitle','Edit Questions Answer');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'question' => 'required',
	    'answer'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/faq/edit/'.$request->get('faq_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
	
         $faq = Faq::find($request->get('faq_id'));
         $faq->quest = $request->get('question');
         $faq->ans =$request->get('answer');
	 $faq->status=$request->get('status');
         $faq->save(); 
		  
         return redirect('/admin/faq')->withFlash_message('Record updated Successfully.');
	     
	}
       
 }
 
?>