<?php namespace App\Http\Controllers\Admin;
use App\Seller; 
use App\Category; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Hash;
use Crypt;
use Mail;
use Image;

class SellerController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
             $user = DB::table('users')->where('role','=','3')->get();  
             return view('admin/seller')->with('users_data',$user)->with('title','Users')->with('subtitle','List');
		
	}
       public function add(){ 
             
             $user = DB::table('users')->get();  
             return view('admin/add_seller')->with('users_data',$user)->with('title','Seller')->with('subtitle','Add');
		
	}
        public function store(Request $request){
	
  
	   $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required|email|unique:users',
            'image'=>'required',
            'mobile'=>'required|numeric|min:6',
            'company_name'=>'required',
            
            'company_pan_no'=>'required',
            'company_tin_no'=>'required',
            'company_address'=>'required',
            'menu_assign'=>'required'
              
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/seller/add')
                        ->withErrors($validator)
                        ->withInput();
        }
	$password = (str_random(6));	 
        $destinationPath = 'uploads/seller/'; // upload path
        $image = Input::file('image');
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        $path = ($destinationPath.$fileName);
        Image::make($image->getRealPath())->resize(200, 200)->save($path);
        $image->move($destinationPath, $fileName); // uploading file to given path
        Seller::create(['image' =>$fileName,'name' =>$request->get('name'),
            'email' =>$request->get('email'),
            'password'=>bcrypt($password),
            'gender'=>$request->get('gender'),
            'address'=>$request->get('address'),
            'mobile'=>$request->get('mobile'),
            'company_name'=>$request->get('company_name'),
            'company_pan_no'=>$request->get('company_pan_no'),
            'company_tin_no'=>$request->get('company_tin_no'),
            'company_address'=>$request->get('company_address'),
            'status' =>$request->get('status'),
            'menu_assign'=>implode(',',$request->get('menu_assign')),
            'role'=>3]);  
           $emails['email'] = $request->get('email'); 
        $copyright=configs_value('Copyright');        
        $em_content=email_section('1');   
        $msg=$em_content->email_body;
        $msg=str_replace("{name}",$request->get('name'),$msg);
        $msg=str_replace("{role}",'Seller',$msg);
        $msg=str_replace("{site_name}",configs_value('Site Name'),$msg);
        $msg=str_replace("{username}",$request->get('email'),$msg);
        $msg=str_replace("{password}",$password,$msg);
        $msg=str_replace("{copyright}",$copyright,$msg);
        $emails['subject']= $em_content->email_subject;
        $emails['name']= configs_value('Site Name');
        $emails['from']=configs_value('SMTP User');
            Mail::send('email',  ['msg' => $msg], function ($message) use ($emails) {
                $message->from('test@infoseeksoftwaresystems.com', 'Laravel');

                $message->to($emails['email'])->subject($emails['subject']);
            });	  
         return redirect('/admin/seller')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	  
	   DB::table('users')->where('id', '=',$chk_id)->delete();		 
           return  redirect('/admin/seller')->withFlash_message('Record Deleted  Successfully.');	 
	    
	}
        
	 public function edit($id){
	
	 $data= DB::table('users')->where('id', '=',$id)->first();  
         $user = DB::table('users')->get();  
	 return view('admin/edit_seller')->with('user_data',$user)->with('data',$data)->with('title','Seller')->with('subtitle','Edit');
	     
	}
         public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
           'name' => 'required',
            'email'=>'required|email',
            
            'mobile'=>'required|numeric|min:6',
            'company_name'=>'required',
            
            'company_pan_no'=>'required',
            'company_tin_no'=>'required',
            'company_address'=>'required',
            'menu_assign'=>'required'            
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/seller/edit/'.$request->get('user_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
		 
          if(Input::file('image')!=''){	 
         $destinationPath = 'uploads/seller/'; // upload path
        $image = Input::file('image');
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        $path = ($destinationPath.$fileName);
        Image::make($image->getRealPath())->resize(200, 200)->save($path);
        $image->move($destinationPath, $fileName); // uploading file to given path
         }
         $cat = Seller::find($request->get('user_id'));
         $cat->name = $request->get('name');
         if((isset($fileName)) && ($fileName!='')){
			$cat->image = $fileName;
         }
                $cat->address =$request->get('address');
                $cat->email=$request->get('email');
                $cat->gender=$request->get('gender');
                $cat->mobile = $request->get('mobile');
                $cat->company_name=$request->get('company_name');
                $cat->company_pan_no=$request->get('company_pan_no');
                $cat->company_tin_no=$request->get('company_tin_no');
                $cat->company_address=$request->get('company_address');
                $cat->menu_assign=implode(',',$request->get('menu_assign'));
                $cat->status=$request->get('status');
                $cat->save(); 
		  
         return redirect('/admin/seller')->withFlash_message('Record updated Successfully.');
	     
	}
        
         public function sendEmailReminder(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
       
 }
 
?>