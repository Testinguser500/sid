<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Enquiry; 
use DB;
use Mail;
use Illuminate\Support\Facades\Input;
use Auth;
use Request;
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
            
             return view('admin/enquirys')->with('title','Enquiry')->with('subtitle','List');
		
	}
       public function all(){ 
             $enquirys = DB::table('enquirys')->where('reply_to', '=','0')->get();  
             return  $enquirys ;
		
	}
        
        public function delete(){
	
	   $chk_id=Request::input('del_id');
           DB::table('enquirys')->where('id', '=',$chk_id)->delete();	
           DB::table('enquirys')->where('reply_to', '=',$chk_id)->delete();
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	    
	}
        
	 public function edit($id){
	
            $enquirys= DB::table('enquirys')->where('id', '=',$id)->first();  
            $replys= DB::table('enquirys')->where('reply_to', '=',$id)->get();  
            $list['reply']=$replys;	 
	    return $list;
	}
         public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'reply' => 'required',	    
                  
            
        ]);
         
        if ($validator->fails()) {
                $list[]='error';
                $msg=$validator->errors()->all();
		$list[]=$msg;
		return $list;
        }
        $emails['subject']=Request::input('subject');
        $msg=Request::input('reply');
        Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
            $message->from('test@infoseeksoftwaresystems.com', 'Laravel');

            $message->to('srishti.infoseek@gmail.com')->subject($emails['subject']);
        });
        Enquiry::create(['name' =>$request->get('name'),'email' =>Request::input('email'),'subject' =>Request::input('subject'),'message'=>Request::input('reply'),'reply_to' =>Request::input('reply_to')]);
        	  
        $list[]='success';
        $list[]='Reply send successfully.';	 
	return $list;
		  
        // return redirect('/admin/enquiry')->withFlash_message('Reply send successfully.');
	     
	}
       
 }
 
?>