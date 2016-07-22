<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Newsletter; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class NewsletterController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	          
        public function index(){ 
              
             return view('admin/newsletters')->with('title','Newsletter')->with('subtitle','List');
		
	}
        public function all(){ 
             $newsletters = DB::table('newsletters')->get();               
             return  $newsletters;
		
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           DB::table('newsletters')->where('id', '=',$chk_id)->delete();	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list; 
	    
	}
        
	 
         public function update(){
	
            $newsletter = Newsletter::find(Request::input('edit_id'));
            $newsletter->subscribe = Request::input('subscribe');        
            $newsletter->save(); 		  
            $list[]='success';
            $list[]='Record is updated successfully.';	 
            return $list;
	     
	}
       
 }
 
?>