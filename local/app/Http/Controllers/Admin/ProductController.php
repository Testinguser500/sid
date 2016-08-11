<?php namespace App\Http\Controllers\Admin;
use App\User; 
use App\Product;
use App\ProductImage;
use App\Category;
use App\Brand;
use App\ProductDataType;
use App\Option;
use App\ProductAttribute;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
use File;
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
	   $optionname   = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',0)->where('id', '=',$pid)->where('status', '=','Active')->get();
	   $return['optionvalues']   = $optionvalues; 
	   $return['optionname']   = $optionname;
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
	    'pro_category_id' => 'required',
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
	$catids= Request::input('pro_category_id'); ;
	$newcatarr= array();
	foreach($catids as $ck => $cv){ 
	    if($cv == '1'){ 
		$newcatarr[] = $ck;	
	    }
	}
	$newproids = implode(",", $newcatarr);
        
	 $prod = Product::create(['pro_name' =>Request::input('pro_name'),
			 'pro_des' =>Request::input('pro_des'),
			 'pro_short_des' =>Request::input('pro_short_des'),
			 'pro_feature_des' =>Request::input('pro_feature_des'),
			 'seller_id' =>Request::input('seller_id'),
			 'pro_category_id' =>$newproids,
			 'brand_id' =>Request::input('brand_id'),
			 'product_tags' =>Request::input('product_tags'),
			 'price' =>Request::input('price'),
			 'sale_price' =>Request::input('sale_price'),
			 'no_stock' =>Request::input('no_stock'),
			 'pro_datatype_id'=>Request::input('pro_datatype_id'),
			 //'pro_opt_name_id'=>Request::input('pro_opt_name_id'),
			 //'pro_opt_values_id'=>$newovids,
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
		$ovids= Request::input('pro_opt_values_id');  
			
			if($ovids){
				    foreach((array)$ovids as $kop => $vop){ 
				    $newopvarr = implode(",",$vop);
				     ProductAttribute::create(['option_name_id' => $kop,
							       'option_value_ids'=> $newopvarr,
							       'product_id' => $insertedId,
							      ]);
				    }	    
			}
			
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
	 $product= DB::table('product')->where('id', '=',$id)->first(); //print_r($product);
	 $product_img = DB::table('product_images')->select('image as img', 'def as def')->where('product_id', '=',$id)->get();
	 $product_attr  = DB::table('product_attribute')->where('product_id', '=',$id)->get(); //print_r($product_attr);
	 $all = array();
	 
	 foreach($product_attr as $kk => $vv){
	  $pr_optid = $vv->option_name_id;
	  $proids = explode(",",$vv->option_value_ids);
	  $pr_all   = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',$pr_optid)->where('status', '=','Active')->get();
          $optionname   = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',0)->where('id', '=',$pr_optid)->where('status', '=','Active')->get();
	  $all[]= array('optid'=>$pr_optid,
			'all'=>$pr_all,
			'parent_name'=> $optionname,
			'opt_ids'=>$proids
			);
	 }
	 $sellers    = DB::table('users')->where('status','=','Active')->where('is_delete','=',0)->where('role','=',5)->get();
	 $categories = DB::table('categorys')->where('status','=','Active')->where('is_delete','=',0)->get();
	 $brands     = DB::table('brands')->where('status','=','Active')->where('is_delete','=','0')->get();
	 $all_category = self::getcataegorywithSub();
	 $datatyps   = DB::table('product_data_type')->get();
	 $options    = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=','0')->where('status', '=','Active')->get();
	 $product->pro_category_id = explode(',',$product->pro_category_id);	 
         $return['sellers']    = $sellers;
         $return['categories'] = $categories;
	 $return['brands']     = $brands;
	 $return['product']    =$product;
	 $return['datatyps']   = $datatyps;
	 $return['options']   = $options;
         $return['all_category'] = $all_category;
	 $return['product_img'] = $product_img;
	 $return['all'] = $all;
         return $return;
	}
	/*******update the data*****/
         public function update(){// print_r(Request::all());
           $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           $validator = Validator::make(Request::all(),[
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
			//'pro_category_id' => 'Product Category',
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
	
	$catids= Request::input('pro_category_id'); print_r($catids);
	$newcatarr= array();
	foreach($catids as $ck => $cv){ 
	    if($cv == '1'){ 
		$newcatarr[] = $ck;	
	    }
	}
	$newproids = implode(",", $newcatarr);
 
         $pro = Product::find(Request::input('id')); 
         $pro->pro_name = Request::input('pro_name');
	 $pro->pro_des =Request::input('pro_des');
	 $pro->pro_short_des=Request::input('pro_short_des');
         $pro->pro_feature_des=Request::input('pro_feature_des');
         $pro->seller_id=Request::input('seller_id');
        // $pro->pro_category_id=Request::input('pro_category_id');
         $pro->brand_id=Request::input('brand_id');
	 $pro->product_tags=Request::input('product_tags');
	 $pro->price=Request::input('price');
	 $pro->sale_price=Request::input('sale_price');
	 $pro->no_stock=Request::input('no_stock');
         $pro->meta_title=Request::input('meta_title');
         $pro->meta_description=Request::input('meta_description');
         $pro->meta_keywords=Request::input('meta_keywords');
	 $pro->status=Request::input('status');
         $pro->save(); 
	 $product_img = DB::table('product_images')->where('product_id', '=',Request::input('id'))->get(); 
	 $product_attr  = DB::table('product_attribute')->where('product_id', '=',Request::input('id'))->get();
	 $images = Request::input('images'); 
	    if($product_img){
	    foreach($images as $imgvvv){
		foreach($product_img as $kim => $vim){
			if(in_array($vim->image,$imgvvv)){
				DB::table('product_images')->where('id', '=', $vim->id)->delete();   
			}
		  }
	    ProductImage::create(['image' => $imgvvv['img'],
	    'product_id' => Request::input('id'),
	    'def' => $imgvvv['def']]);
	    }
	    }
	    else{
	    foreach($images as $imgvvv){
	    ProductImage::create(['image' => $imgvvv['img'],
	    'product_id' => Request::input('id'),
	    'def' => $imgvvv['def']]);
	    }
	    }
	 
            $ovids= Request::input('pro_opt_values_id');
	    
	    if($product_attr){
			foreach($product_attr as $kattr => $vattr){
			DB::table('product_attribute')->where('id', '=', $vattr->id)->delete();	    
			}
			
			if($ovids){
			foreach($ovids as $kop => $vop){ 
			$newopvarr = implode(",",$vop);
			ProductAttribute::create(['option_name_id' => $kop,
			'option_value_ids'=> $newopvarr,
			'product_id' => Request::input('id'),
			]);
			}
			}
	    }
	    else{
			if($ovids){
			foreach($ovids as $kop => $vop){ 
			$newopvarr = implode(",",$vop);
			ProductAttribute::create(['option_name_id' => $kop,
			'option_value_ids'=> $newopvarr,
			'product_id' => Request::input('id'),
			]);
			}	    
			}
	    }
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	 }
	 
	 
	 public function image_delete(){
	    $image = Request::input('image');
	    File::delete('uploads/'.str_replace('product/','product/thumb_',$image));
	    File::delete('uploads/'.str_replace('product/','product/mid_',$image));
	    File::delete('uploads/'.$image);
	    DB::table('product_images')->where('image', '=', $image)->delete(); 
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