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
use Response;
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
        public function export(){
                $table = DB::table('newsletters')->get();   
                $filename = "newsletter.csv";
                $handle = fopen($filename, 'w+');
                fputcsv($handle, array('Name', 'E-mail', 'Mobile No.', 'Occupation', 'City', 'Gender', 'Subscribe', 'Created At', 'Updated at'), ';');

                foreach($table as $row) {
                    if($row->subscribe=='1'){
                       $subs="Subscribe"; 
                    }else{
                       $subs="Unsubscribe";   
                    }
                    fputcsv($handle, array($row->name, $row->email, $row->mob_no, $row->occupation,$row->city, $row->gender, $subs, $row->created_at, $row->updated_at), ';');
                }

                fclose($handle);
                $headers = array(
                    'Content-Type' => 'text/csv',
                );
               return Response::download($filename, 'newsletter.csv', $headers); 
           }
        public function store(){
	
	   $validator = Validator::make(Request::all(), [
            'name' => 'required',	       
            'email'=>'required|unique:newsletters,email|email',            
            'mobile_no'=>'required|numeric',
            'occupation'=>'required',
            'city'=>'required',
            
        ]);
           
       
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
	
	$news= Newsletter::create(['name' =>Request::input('name'),'email' =>Request::input('email'),'mob_no' =>Request::input('mobile_no'),'occupation' =>Request::input('occupation'),'city' =>Request::input('city'),'gender' =>Request::input('gender'),'subscribe' =>'1']);  
	  
            $list[]='success';
            $list[]='Subscriber is added successfully.You can add more Subscriber.';	 
	    return $list;
	   
	}
        public function delete(){
	
	   $chk_id=Request::input('del_id');	
           DB::table('newsletters')->where('id', '=',$chk_id)->delete();	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list; 
	    
	}
        
	 
         public function update(){
	   $validator = Validator::make(Request::all(), [
                'name' => 'required',	       
                'email'=>'required|unique:newsletters,email,'.Request::input('edit_id').',id|email',            
                'mobile_no'=>'required|numeric',
                'occupation'=>'required',
                'city'=>'required',
            
           ]);
             if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
          }
            $newsletter = Newsletter::find(Request::input('edit_id'));
            $newsletter->name = Request::input('name');   
            $newsletter->email = Request::input('email'); 
            $newsletter->mob_no = Request::input('mobile_no');
            $newsletter->occupation = Request::input('occupation');
            $newsletter->city = Request::input('city');
            $newsletter->save(); 		  
            $list[]='success';
            $list[]='Record is updated successfully.';	 
            return $list;
	     
	}
         public function update_subscribe(){
	     
            $newsletter = Newsletter::find(Request::input('edit_id'));
            $newsletter->subscribe = Request::input('subscribe');               
            $newsletter->save(); 		  
            $list[]='success';
            $list[]='Record is updated successfully.';	 
            return $list;
	     
	}
       
 }
 
?>