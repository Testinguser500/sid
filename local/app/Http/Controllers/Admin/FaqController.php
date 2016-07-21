<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Faq; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class FaqController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
            
             return view('admin/faqs')->with('title','Faq')->with('subtitle','List');
		
	}
        public function all(){ 
             $faqs = DB::table('faqs')->get();  
             return $faqs ;
		
	}
       
        public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'question' => 'required',
	    'answer'=>'required',                    
            
        ]);
         
        if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
        }
	       
	 Faq::create(['quest' =>Request::input('question'),'ans' =>Request::input('answer'),'status' =>Request::input('status')]);  
		  
         $list[]='success';
         $list[]='Record is added successfully.';	 
	 return $list;
	   
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           DB::table('faqs')->where('id', '=',$chk_id)->delete();    		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	    
	}
        
	 public function edit($id){
	 $faq= DB::table('faqs')->where('id', '=',$id)->first(); 
         $return['data']=$faq;
         return $return;
	     
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'question' => 'required',
	    'answer'=>'required',        
            
        ]);
         
        if ($validator->fails()) {
                    $list[]='error';
                    $msg=$validator->errors()->all();
                    $list[]=$msg;
                    return $list;
        }
	
         $faq = Faq::find(Request::input('faq_id'));
         $faq->quest = Request::input('question');
         $faq->ans =Request::input('answer');
	 $faq->status=Request::input('status');
         $faq->save(); 
		  
         $list[]='success';
         $list[]='Record is updated successfully.';	 
	 return $list;
	     
	}
       
 }
 
?>