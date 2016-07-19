<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Enquiry; 
use DB;
use Mail;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class EnquiryController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $enquirys = DB::table('enquirys')->where('reply_to', '=','0')->get();  
             return view('admin/enquirys')->with('enquirys',$enquirys)->with('title','Enquiry')->with('subtitle','List');
		
	}
       
        
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');
           DB::table('enquirys')->where('id', '=',$chk_id)->delete();	
           DB::table('enquirys')->where('reply_to', '=',$chk_id)->delete();
           return  redirect('/admin/enquiry')->withFlash_message('Enquiry Deleted Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $enquirys= DB::table('enquirys')->where('id', '=',$id)->first();  
         $replys= DB::table('enquirys')->where('reply_to', '=',$id)->get();  
	 return view('admin/edit_enquirys')->with('enquirys',$enquirys)->with('replys',$replys)->with('title','Enquiry')->with('subtitle','Reply');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'reply' => 'required',	    
                  
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/enquiry/edit/'.$request->get('reply_to'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $emails['subject']=$request->get('subject');
        $msg=$request->get('reply');
        Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
            $message->from('test@infoseeksoftwaresystems.com', 'Laravel');

            $message->to('srishti.infoseek@gmail.com')->subject($emails['subject']);
        });
        Enquiry::create(['name' =>$request->get('name'),'email' =>$request->get('email'),'subject' =>$request->get('subject'),'message'=>$request->get('reply'),'reply_to' =>$request->get('reply_to')]);

		  
         return redirect('/admin/enquiry')->withFlash_message('Reply send successfully.');
	     
	}
       
 }
 
?>