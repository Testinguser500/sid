<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Template; 
use App\Newsletter; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Mail;
use Request;
class TemplateController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
              
             return view('admin/template')->with('title','Template')->with('subtitle','List');
		
	}
        public function all(){ 
             $templates = DB::table('templates')->get();  
             return $templates ;
		
	}
   
        public function store(Request $request){
	
  
	   $validator = Validator::make(Request::all(), [
            'subject' => 'required',
	    'message'=>'required',                   
            
        ]);
         
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
		 
        
	 Template::create(['subject' =>Request::input('subject'),'content' =>Request::input('message')]);  
	    $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;  
        
	   
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           $templates = DB::table('templates')->where('id', '=',$chk_id)->delete();   	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;
	    
	}
        
	 public function edit($id){
	
	 $template= DB::table('templates')->where('id', '=',$id)->first();  
         $return['data']=$template;
	 return $return;    
	}
         public function update(){
	
	    $validator = Validator::make(Request::all(), [
            'subject' => 'required',
	    'message'=>'required',                   
            
        ]);
            
            if ($validator->fails()) {
                                  $list[]='error';
                                  $msg=$validator->errors()->all();
                                  $list[]=$msg;
                                  return $list;
            }
	
            $temp = Template::find(Request::input('template_id'));
            $temp->subject = Request::input('subject');
            $temp->content = Request::input('message');
            $temp->save(); 		  
            $list[]='success';
            $list[]='Record is updated successfully.';	 
	    return $list;
	     
	}
       
         public function sent(){
	
	    $validator = Validator::make(Request::all(), [
            'user' => 'required',                   
            
           ]);            
        if ($validator->fails()) {
            $list[]='error';
            $msg=$validator->errors()->all();
            $list[]=$msg;
            return $list;
        }
	$template=DB::table('templates')->where('id', '=',Request::input('template_id'))->first();  
        $copyright=configs_value('Copyright');        
        $em_content=email_section('5');   
        $msg=$em_content->email_body;
        $msg=str_replace("{content}",$template->content,$msg);
        $msg=str_replace("{copyright}",$copyright,$msg);
	$emails['subject']= $template->subject;
        $emails['name']= configs_value('Site Name');
        $emails['from']=configs_value('SMTP User');
        $users=Request::input('user');          
        if (array_key_exists('subscriber', $users)) {
             if($users['subscriber']=='1')
             {
                  $newsletter= DB::table('newsletters')->where('subscribe', '=','1')->get();  
                  foreach($newsletter as $key=>$val){
                    $emails['to'] =$val->email;
                    Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
                    $message->from($emails['from'], $emails['name']);
                    $message->to($emails['to'])->subject($emails['subject']);
                    });	
                  }
             }
        }
         if (array_key_exists('seller', $users)) {
                if($users['seller']=='1')
                {
                    $seller= DB::table('users')->where('role', '=','5')->where('status', '=','Active')->get();  
                    foreach($seller as $key=>$val){
                    $emails['to'] =$val->email;
                    Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
                    $message->from($emails['from'], $emails['name']);
                    $message->to($emails['to'])->subject($emails['subject']);
                    });	
                  }
                }
        }
         if (array_key_exists('customer', $users)) {
              if($users['customer']=='1')
                {
                    $customer= DB::table('users')->where('role', '=','3')->where('status', '=','Active')->get();  
                    foreach($customer as $key=>$val){
                    $emails['to'] =$val->email;
                    Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
                    $message->from($emails['from'], $emails['name']);
                    $message->to($emails['to'])->subject($emails['subject']);
                    });	
                  }
                }
        }
       
//        $newsletter= DB::table('newsletters')->where('id', '=',$val)->first();  
//        $emails['to'] =$newsletter->email;
//        Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
//            $message->from($emails['from'], $emails['name']);
//            $message->to($emails['to'])->subject($emails['subject']);
//        });	
       
        
	     
	}
       
 }
 
?>