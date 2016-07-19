<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Newsletter; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class NewsletterController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $category = DB::table('newsletters')->get();  
             return view('admin/newsletters')->with('newsletters',$category)->with('title','Newsletter')->with('subtitle','List');
		
	}
              
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	
           DB::table('newsletters')->where('id', '=',$chk_id)->delete();	   		 
           return  redirect('/admin/newsletter')->withFlash_message('Record Deleted Successfully.');	 
	    
	}
        
	 
         public function update(Request $request){
	
            $newsletter = Newsletter::find($request->get('edit_id'));
            $newsletter->subscribe = $request->get('subscribe');        
            $newsletter->save(); 		  
            return redirect('/admin/newsletter')->withFlash_message('Record updated Successfully.');
	     
	}
       
 }
 
?>