<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Product;
use App\ProductImage;
use App\Category;
use App\Brand;
use App\ProductDataType;
use App\Option; 
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
class ProductController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
	public function index(){ 
            
             return view('admin/product')->with('title','Product')->with('subtitle','List');
		
	}
        public function all(){ 
	     $products   = DB::table('product')->select('categorys.category_name as category_name', 'product.*')->join('categorys', 'product.pro_category_id', '=', 'categorys.id')->where('product.is_delete','=','0')->get();
             $sellers    = DB::table('users')->where('status','=','Active')->where('is_delete','=',0)->where('role','=',5)->get();
	     $categories = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
	     $brands     = DB::table('brands')->where('status','=','Active')->where('is_delete','=','0')->get(); 
	     $all_category = self::getcataegorywithSub();
	     $brands     = DB::table('brands')->where('status','=','Active')->where('is_delete','=','0')->get();
	     $datatyps   = DB::table('product_data_type')->get();
	     $options    = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=','0')->where('status', '=','Active')->get(); 
	//     foreach($products as $kk => $vv){
	//	$images    = DB::table('product_images')->where('product_id','=',$vv->id)->get();	
	//     }
	     //$return['images']     = $images;

	     $return['products']   = $products;
	     $return['sellers']    = $sellers;
	     $return['categories'] = $categories;
	     $return['brands']     = $brands;
	     $return['datatyps']   = $datatyps;
	     $return['options']   = $options;
	     $return['all_category'] = $all_category;
	     return $return ;
	}
	
	public function getoptionvalue(){
	   $pid= Request::input('parent_id');
	   $optionvalues    = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',$pid)->where('status', '=','Active')->get();
	   $return['optionvalues']   = $optionvalues;
	   return $return;
	}
	
       /*******insert the data*****/
        public function store(){
	    $catids= array();
	    $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
	   $validator = Validator::make(Request::all(), [
            'pro_name' => 'required',
	    'pro_des' => 'required',
	    'pro_short_des' => 'required',
	    'pro_feature_des' => 'required',
	    'seller_id' => 'required',
	    //'pro_category_id' => 'required',
	    'brand_id' => 'required',
	    'product_tags' => 'required',
	    'price' => ['required','regex:'.$regex],
	    'sale_price' => ['required','regex:'.$regex],
	    'no_stock' => 'required|integer|min:0',
	    'length' => 'required_with:width,height|check_demension_value',
	    'width' => 'required_with:length,height|check_demension_value',
	    'height' => 'required_with:length,width|check_demension_value',
	    'meta_title' => 'required',
	    'meta_description' => 'required',
	    'meta_keywords' => 'required'                    
        ]);
	   $friendly_names = array(
			'pro_name' => 'Product Name',
			'pro_des' => 'Product Description',
			'pro_short_des' => 'Product Short Description',
			'pro_feature_des' => 'Product Feature Description',
			'seller_id' => 'Seller',
			'pro_category_id' => 'Product Category',
			'brand_id' => 'Brand',
			'product_tags' => 'Product Tags',
			'price' => 'Price',
			'sale_price' => 'Sale Price',
			'no_stock' => 'No. of Stock',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords' 
		    );
	$validator->setAttributeNames($friendly_names);
        if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      $list[]=$msg;
	      return $list;
        }
	//$catids= Request::input('pro_category_id');
	//$newproids = implode(",", array_keys($catids));
	//echo "grty";
       $ovids= Request::input('pro_opt_values_id'); 
	$newovids = implode(",", $ovids); 
	
	 $prod = Product::create(['pro_name' =>Request::input('pro_name'),
			 'pro_des' =>Request::input('pro_des'),
			 'pro_short_des' =>Request::input('pro_short_des'),
			 'pro_feature_des' =>Request::input('pro_feature_des'),
			 'seller_id' =>Request::input('seller_id'),
			// 'pro_category_id' =>$newproids,
			 'brand_id' =>Request::input('brand_id'),
			 'product_tags' =>Request::input('product_tags'),
			 'price' =>Request::input('price'),
			 'sale_price' =>Request::input('sale_price'),
			 'no_stock' =>Request::input('no_stock'),
			 'pro_datatype_id'=>Request::input('pro_datatype_id'),
			 'pro_opt_name_id'=>Request::input('pro_opt_name_id'),
			'pro_opt_values_id'=>$newovids,
			 'sku'=>Request::input('sku'),
			 'date_from'=>Request::input('date_from'),
			 'date_to'=>Request::input('date_to'),
			 'video'=>Request::input('video'),
			 'weight'=>Request::input('weight'),
			 'length'=>Request::input('length'),
			 'width'=>Request::input('width'),
			 'height'=>Request::input('height'),
			 'meta_title' =>Request::input('meta_title'),
			 'meta_description' =>Request::input('meta_description'),
			 'meta_keywords' =>Request::input('meta_keywords'),
			 'status' =>Request::input('status')]);
	 
		$insertedId = $prod->id;
		if($insertedId > 0){
			$images = Request::input('images'); //print_r($images);
			 foreach($images as $imgvvv){
			ProductImage::create(['image' => $imgvvv['img'],
			 'product_id' => $insertedId,
			 'def' => $imgvvv['def']]);
			} 
		}
         $list[]='success';
         $list[]='Record is added successfully.';	 
	 return $list;
	   
	}
	
	/*******delete the data*****/
        public function delete(){
	   $chk_id=Request::input('del_id');
	   $data = Product::find($chk_id);
           $data->is_delete = '1';
           $data->save(); 	   		 
           $list[]='success';
           $list[]='Record is deleted successfully.';	 
	   return $list;	 
	}
        
	/*******edit the data*****/
	 public function edit($id){
	 $product= DB::table('product')->where('id', '=',$id)->first();
	 $sellers    = DB::table('users')->where('status','=','Active')->where('is_delete','=',0)->where('role','=',5)->get();
	 $categories = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
	 $brands     = DB::table('brands')->where('status','=','Active')->where('is_delete','=','0')->get(); 
         $return['sellers']    = $sellers;
         $return['categories'] = $categories;
	 $return['brands']     = $brands;
	 $return['product']    =$product;
         return $return;
	}
	/*******update the data*****/
         public function update(){
           $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           $validator = Validator::make(Request::all(),[
            'pro_name' => 'required',
	    'pro_des' => 'required',
	    'pro_short_des' => 'required',
	    'pro_feature_des' => 'required',
	    'seller_id' => 'required',
	    'pro_category_id' => 'required',
	    'brand_id' => 'required',
	    'product_tags' => 'required',
	    'price' => ['required','regex:'.$regex],
	    'no_stock' => 'required|integer|min:0',
	    'meta_title' => 'required',
	    'meta_description' => 'required',
	    'meta_keywords' => 'required'                    
        ]);
	   $friendly_names = array(
			'pro_name' => 'Product Name',
			'pro_des' => 'Product Description',
			'pro_short_des' => 'Product Short Description',
			'pro_feature_des' => 'Product Feature Description',
			'seller_id' => 'Seller',
			'pro_category_id' => 'Product Category',
			'brand_id' => 'Brand',
			'product_tags' => 'Product Tags',
			'price' => 'Price',
			'no_stock' => 'No. of Stock',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords' 
		    );
	$validator->setAttributeNames($friendly_names);
        if ($validator->fails()) {
                              $list[]='error';
                              $msg=$validator->errors()->all();
			      $list[]=$msg;
			      return $list;
        }
 
         $pro = Product::find(Request::input('id')); 
         $pro->pro_name = Request::input('pro_name');
	 $pro->pro_des =Request::input('pro_des');
	 $pro->pro_short_des=Request::input('pro_short_des');
         $pro->pro_feature_des=Request::input('pro_feature_des');
         $pro->seller_id=Request::input('seller_id');
         $pro->pro_category_id=Request::input('pro_category_id');
         $pro->brand_id=Request::input('brand_id');
	 $pro->product_tags=Request::input('product_tags');
	 $pro->price=Request::input('price');
	 $pro->no_stock=Request::input('no_stock');
         $pro->meta_title=Request::input('meta_title');
         $pro->meta_description=Request::input('meta_description');
         $pro->meta_keywords=Request::input('meta_keywords');
	 $pro->status=Request::input('status');
         $pro->save(); 
		  
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	 }
    
	public function getcataegorywithSub($pid=0)
	{
		$categories = array();
		$result = DB::table('categorys')->where('is_delete', '=','0')->where('parent_id','=',$pid)->get();
		foreach((array)$result as $key=>$mainCategory)
		{
			$category = array();
			 $category['id'] = $mainCategory->id;
			$category['name'] = $mainCategory->category_name;
			$category['parent_id'] = $mainCategory->parent_id;
			$mainCategory->all_category = self::getcataegorywithSub($category['id']);
			$categories[$mainCategory->id] = $category;
			//$sub = DB::table('categorys')->where('is_delete', '=','0')->where('parent_id','=',$val->id)->get();
			//$val->sub = $sub;
			//$result[$key]=$val;
			
			//$result[$key]->sub = self::getcataegorywithSub($val->id);
			
		}
		
		return $result;
	}
 }
 
?>