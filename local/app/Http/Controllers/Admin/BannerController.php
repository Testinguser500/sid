<?php namespace App\Http\Controllers\Admin;
use App\Banner; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Request;
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
    public function all(){ 
             $banner = DB::table('banners')->get();  
			 $bannerType = bannerType();
			 $return['banner'] = $banner;
			 $return['banner_type'] = $bannerType;
             return  $return;
			 
	}

    public function store(){
	
  
	   $validator = Validator::make(Request::all(), [
            'title' => 'required',
            'banner_type'=>'required',
            'url'=>'required',
            'image'=>'required',
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
		 
        //$bannerType = bannerType(Request::input('position_id'));
        $image = Request::input('image');
        //$fileName = imageUpload($image,'banner',$bannerType['thumb'],$bannerType['mid']);
		
				 
        Banner::create(['image' =>$image,'title' =>Request::input('title'),'position_id' =>Request::input('banner_type'),'url'=>Request::input('url'),'status' =>Request::input('status'),'user_id'=>Auth::user()->id]);  
		  
         $list[]='success';
            $list[]='Record is added successfully.';	 
	    return $list;
	   
	}
       public function delete(){
	
	   $chk_id=Request::input('del_id');
           $banner = Banner::find($chk_id);
           
           $banner->delete(); 	  		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
			return $list;
	    
	}
	public function edit($id){
	
	$banner= DB::table('banners')->where('id', '=',$id)->first();  
	$bannerType = bannerType();
			 $return['banners'] = $banner;
			 $return['banner_type'] = $bannerType;
	return $return; 
	     
	}
         
 public function update(){
	
	  $validator = Validator::make(Request::all(), [
            'title' => 'required',
            'banner_type'=>'required',
            'url'=>'required',
                    
            
        ]);
         
        if ($validator->fails()) {
            $list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
	 if(Request::input('image')!=''){	 
            
             $fileName = Request::input('image');
            
         }
         $cat = Banner::find(Request::input('id'));
         $cat->title = Request::input('title');
         if((isset($fileName)) && ($fileName!='')){
	 $cat->image = $fileName;
         }
	 $cat->position_id =Request::input('banner_type');
         $cat->url =Request::input('url');
	 $cat->status =Request::input('status');
	 
         $cat->save(); 
		  
         $list[]='success';
            $list[]='Record is updated successfully.';	 
	    return $list;
	     
	}
	
	//banner upload image
function bannerImageUpload()
{
	if(Request::input('folder'))
			$folder = Request::input('folder');
		
	$banner_type= Request::input('banner_type');
	if($banner_type)
		$banner = bannerType($banner_type);
	if($banner)
	{
		$thumb = $banner['thumb'];
		$mid = $banner['mid'];
	}
	if(Input::file('image'))
	{
		$destinationPath = 'uploads/'.$folder.'/'; // upload path
		$image = Input::file('image');
		$extension = $image->getClientOriginalExtension(); // getting image extension
		$fileName = rand(11111,99999).'.'.$extension; // renameing image
		//Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		
		if($thumb)
		{
			$width = $thumb['width'];
			$height = $thumb['height'];
			$path = ($destinationPath . 'thumb_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
		
		}
		if($mid)
		{
			$width = $mid['width'];
			$height = $mid['height'];
			$path = ($destinationPath . 'mid_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
		}
		if($image->move($destinationPath, $fileName))
                {
                    //Storage::Delete($destinationPath.$oldImage);
                    //File::Delete($destinationPath.$oldImage);
                    //File::Delete($destinationPath.'thumb_'.$oldImage);
                    //File::Delete($destinationPath.'mid_'.$oldImage);
                    
                }
		return $fileName;
	}
}
}