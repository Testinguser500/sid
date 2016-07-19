<?php namespace App\Http\Controllers\Admin;
use App\Banner; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Image;
use Storage;

class BannerController extends Controller
{

	public function __construct()
		{
			$this->middleware('auth');
			

		}
	
	public function index(){ 
             $banner = DB::table('banners')->get();  
             return view('admin/banner')->with('banner_data',$banner)->with('title','Banners')->with('subtitle','List');
		
	}
	
        public function add(){ 
             
             $banner = DB::table('banners')->get();  
             return view('admin/banner_add')->with('banner_data',$banner)->with('title','Banner')->with('subtitle','Add');
		
	}
        public function store(Request $request){
	
  
	   $validator = Validator::make($request->all(), [
            'title' => 'required',
            'position_id'=>'required',
            'url'=>'required',
            'image'=>'required',
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/banner/add')
                        ->withErrors($validator)
                        ->withInput();
        }
		 
        $bannerType = bannerType($request->get('position_id'));
        $image = Input::file('image');
        $fileName = imageUpload($image,'banner',$bannerType['thumb'],$bannerType['mid']);
		
				 
        Banner::create(['image' =>$fileName,'title' =>$request->get('title'),'position_id' =>$request->get('position_id'),'url'=>$request->get('url'),'status' =>$request->get('status')]);  
		  
         return redirect('/admin/banner')->withFlash_message('Record inserted Successfully.');
	   
	}
        public function delete(Request $request){
	
	   $chk_id=$request->get('del_id');	  
	   DB::table('users')->where('id', '=',$chk_id)->delete();		 
           return  redirect('/admin/user')->withFlash_message('Record Deleted  Successfully.');	 
	    
	}
	public function edit($id){
	
	 $banner= DB::table('banners')->where('id', '=',$id)->first();  
         $static_data = DB::table('banners')->get();  
	 return view('admin/banner_edit')->with('banner_data',$static_data)->with('banner',$banner)->with('title','Banner')->with('subtitle','Edit');
	     
	}
         
 public function update(Request $request){
	
	  $validator = Validator::make($request->all(), [
            'title' => 'required',
            'position_id'=>'required',
            'url'=>'required',
                    
            
        ]);
         
        if ($validator->fails()) {
            return redirect('/admin/banner/edit/'.$request->get('banner_id'))
                        ->withErrors($validator)
                        ->withInput();
        }
	 if(Input::file('image')!=''){	 
            $bannerType = bannerType($request->get('position_id'));
            $image = Input::file('image');
            $fileName = imageUpload($image,'banner',$bannerType['thumb'],$bannerType['mid'],$request->get('old_image'));
         }
         $cat = Banner::find($request->get('banner_id'));
         $cat->title = $request->get('title');
         if((isset($fileName)) && ($fileName!='')){
	 $cat->image = $fileName;
         }
	 $cat->position_id =$request->get('position_id');
         $cat->url =$request->get('url');
	 $cat->status =$request->get('status');
         $cat->save(); 
		  
         return redirect('/admin/banner')->withFlash_message('Record updated Successfully.');
	     
	}
}