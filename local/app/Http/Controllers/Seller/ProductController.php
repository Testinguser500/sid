<?php namespace App\Http\Controllers\Seller;
use App\User; 
use App\Product;
use App\ProductImage;
use App\Category;
use App\Brand;
use App\ProductDataType;
use App\Option;
use App\ProductAttribute;
use App\ProductTags;
use App\ProductVariation;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Request;
use File;
use Response;
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
	    $cat_id= Request::input('cat_id');
	    $product_id = Request::input('product_id');
	    
	     $categories = self::getSubcataegoryByID($cat_id);
	     $brands     = DB::table('brands')->where('status','=','Active')->where('is_delete','=','0')->get(); 
	     //$all_category = self::getcataegorywithSub();
	     $datatyps   = DB::table('product_data_type')->get();
	     $options    = DB::table('pro_option')->where('is_delete', '=','0')->whereRaw('FIND_IN_SET("'.$cat_id.'",categorys_id)')->where('status', '=','Active')->get();
	     $opt_data = array();
	     foreach($options as $opt)
	     {
		$options_value    = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id','=',$opt->id)->where('status', '=','Active')->get();
		foreach($options_value as $op)
		{
			$op->op_data = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id','=',$op->id)->where('status', '=','Active')->get();
			$opt_data[] = $op;
			
		}
	     }
	//     foreach($products as $kk => $vv){
	//	$images    = DB::table('product_images')->where('product_id','=',$vv->id)->get();	
	//     }
	     //$return['images']     = $images;

	     
	     $return['categories'] = $categories;
	     $return['brands']     = $brands;
	     $return['datatyps']   = $datatyps;
	     $return['options']   = $opt_data;
	     //$return['all_category'] = $all_category;
	     
	     return $return ;
	}
	public function category_list()
	{
	    return view('seller/product_list');
	}
	public function getCategory()
	{
	    
	    $category = DB::table('categorys')->where('parent_id','=',0)->where('status','=','Active')->get();
	    $return['category'] = $category;
	    return $return;
	}
	public function getSubCategory()
	{
	    $return='';
	    $pid = Request::input('pid');
	    $category = DB::table('categorys')->where('parent_id','=',$pid)->where('status','=','Active')->get();
	    if($category)
	    $return['category'] = $category;
	    return $return;
	}
	public function getProduct()
	{
	     $pro_id= Request::input('pro_id');
	    $product=DB::table('product')->select('product.*','product_images.image','product_images.def')->join('product_images','product.id','=','product_images.product_id')->whereRaw('FIND_IN_SET("'.$pro_id.'",product.pro_category_id)')->where('product_images.def','=',1)->get();
	    return $product;
	}
	public function getoptionvalue(){
	   $pid= Request::input('opt_id');
	   $optionvalues    = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',$pid)->where('status', '=','Active')->get();
	   $optionname   = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id', '=',0)->where('id', '=',$pid)->where('status', '=','Active')->get();
	   $return['optionvalues']   = $optionvalues; 
	   $return['optionname']   = $optionname;
	   return $return;
	}
	/****Move to trash ******/
	public function deleteAll(){
	
	    $action = Request::input('action');
	   $chk_id=Request::input('id');
	   foreach((array)$chk_id as $key=>$id)
	   {
		   if($id)
			   $product_id[]=$key;
	   }
		if($action=='delete')	   
		{
			DB::table('product')
            ->whereIn('id', $product_id)
            ->update(['is_delete' => '1']);
		
			$list[]='success';
			$list[]='Record is deleted successfully.';	 
			return $list;
		}
		
	    
	}
       /*******insert the data*****/
        public function store(){ //print_r(Request::all());
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
	    //'pro_datatype_id'=> 'check_product_data_type:price,sale_price,date_from,date_to|check_variable_product_data_type:variation_status',
	    //'product_tags' => 'required',
	    'price' => ['regex:'.$regex],
	    'sale_price' => ['regex:'.$regex],
	    'date_from'=> 'date|check_date_valid',
	    'date_to'=> 'date|check_date_to_valid:date_from',
	    'no_stock' => 'integer|min:0',
	    'length' => 'required_with:width,height|check_demension_value',
	    'width' => 'required_with:length,height|check_demension_value',
	    'height' => 'required_with:length,width|check_demension_value',
	    'meta_title' => 'required',
	    'meta_description' => 'required',
	    'meta_keywords' => 'required'                    
        ]);
	  $pro_datatype_id= Request::input('pro_datatype_id');
	   if($pro_datatype_id =='1'){ 
	    $validator1 = Validator::make(Request::all(), [
	    'pro_datatype_id'=> 'check_product_data_type:price,sale_price,date_from,date_to',
							 ]);
	   }
	   elseif($pro_datatype_id == '2'){
	    $validator1 = Validator::make(Request::all(), [
	    'pro_datatype_id'=> 'check_variable_product_data_type:variation_status',
							 ]);
	   }
	   
	   $friendly_names = array(
			'pro_name' => 'Product Name',
			'pro_des' => 'Product Description',
			'pro_short_des' => 'Product Short Description',
			'pro_feature_des' => 'Product Feature Description',
			'seller_id' => 'Seller',
			'pro_category_id' => 'Product Category',
			'brand_id' => 'Brand',
			//'product_tags' => 'Product Tags',
			'price' => 'Price',
			'sale_price' => 'Sale Price',
			'date_from'=> 'Date From',
			'date_to'=> 'Date To',
			'no_stock' => 'No. of Stock',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords' 
		    );
	$validator->setAttributeNames($friendly_names);
        if ($validator->fails()) {
              $list[]='error';
              $msg=$validator->errors()->all();
	      //$list[]=$msg;
	   //   return $list;
        }
	//$msg1 = array();
	if ($validator1->fails()) {
              //$list[]='error';
              $msg1=$validator1->errors()->all();
	    array_push($msg,$msg1[0]);
	
	     // $list[]=$msg;
	     //return $list;
        }
	if ($validator->fails() || $validator1->fails()){
	    $list[]=$msg;
	  return $list;  
	}
	
	$catids= Request::input('pro_category_id');
	if($catids){
	    $newcatarr= array();
	foreach($catids as $ck => $cv){ 
	    if($cv == '1'){ 
		$newcatarr[] = $ck;	
	    }
	}
	$newproids = implode(",", $newcatarr);
	}
	
        
	 $prod = Product::create(['pro_name' =>Request::input('pro_name'),
			 'pro_des' =>Request::input('pro_des'),
			 'pro_short_des' =>Request::input('pro_short_des'),
			 'pro_feature_des' =>Request::input('pro_feature_des'),
			 'seller_id' =>Request::input('seller_id'),
			 'pro_category_id' => $newproids ? $newproids : '',
			 'brand_id' =>Request::input('brand_id'),
			 //'product_tags' =>Request::input('product_tags'),
			 'price' =>Request::input('price') ? Request::input('price') : 0,
			 'sale_price' =>Request::input('sale_price') ? Request::input('sale_price') : 0,
			 'no_stock' =>Request::input('no_stock') ? Request::input('no_stock') : 0,
			 'pro_datatype_id'=>Request::input('pro_datatype_id'),
			 //'pro_opt_name_id'=>Request::input('pro_opt_name_id'),
			 //'pro_opt_values_id'=>$newovids,
			 'sku'=>Request::input('sku') ? Request::input('sku') : '',
			 'date_from'=>Request::input('date_from')? Request::input('date_from') : date('Y-m-d'),
			 'date_to'=>Request::input('date_to') ? Request::input('date_to') : 0000-00-00,
			 'video'=>Request::input('video'),
			 'weight'=>Request::input('weight'),
			 'length'=>Request::input('length'),
			 'width'=>Request::input('width'),
			 'height'=>Request::input('height'),
			 'warranty'=>Request::input('warranty'),
			 'return_policy'=>Request::input('return_policy'),
			 'meta_title' =>Request::input('meta_title'),
			 'meta_description' =>Request::input('meta_description'),
			 'meta_keywords' =>Request::input('meta_keywords'),
			 'stock_status' =>Request::input('stock_status') ? Request::input('stock_status') : 'In Stock',
			 'status' =>Request::input('status')]);
	 
		$insertedId = $prod->id;
		$ovids= Request::input('pro_opt_values_id');
		$variation_status= Request::input('variation_status'); //echo $variation_status;
			
			if($ovids){
			foreach((array)$ovids as $kop => $vop){ 
			$newopvarr = implode(",",$vop);
			 ProductAttribute::create(['option_name_id' => $kop,
						   'option_value_ids'=> $newopvarr,
						   'product_id' => $insertedId,
						   'variation_status' => ($variation_status[$kop] == '1') ? $variation_status[$kop] : 0,
						  ]);
			}	    
			}
			
		$tags= Request::input('tags'); 
		if($tags){
			foreach($tags as $tk => $tv){
			ProductTags::create(['pro_tags'=> $tv['tag'],
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
	    $data_type_id = Request::input('pro_datatype_id');
	    if($data_type_id == 2){
		$vari_name = Request::input('vari_name');
		$vari_sku = Request::input('vari_sku');
		$vari_price = Request::input('vari_price');
		$vari_sale_price = Request::input('vari_sale_price');
		$vari_stock = Request::input('vari_stock');
		
		$newVariArr = array();
		foreach($vari_name as $vnk => $vnv){
			foreach($vnv as $kk => $vv){
			$newVariArr[] = $vv;	    
			}
			$combination_set = implode(',',$newVariArr);
			ProductVariation::create(['vari_comb_value_ids',
						  'product_id',
						  'vari_sku',
						  'vari_price',
						  'vari_sale_price',
						  'vari_stock',
						  'product_id' => $insertedId
			                        ]);
			$vari_sku[$vnk];
			
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
         $product_tag  = DB::table('product_tags')->select('pro_tags as tag')->where('product_id', '=',$id)->get();
	 
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
	 //$product->date_from = date('Y-m-d',strtotime($product->date_from));
         $return['sellers']    = $sellers;
         $return['categories'] = $categories;
	 $return['brands']     = $brands;
	 $return['product']    =$product;
	 $return['datatyps']   = $datatyps;
	 $return['options']   = $options;
         $return['all_category'] = $all_category;
	 $return['product_img'] = $product_img;
	 $return['product_tag'] = $product_tag;
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
	    //'product_tags' => 'required',
	    'price' => ['required','regex:'.$regex],
	    'sale_price' => ['required','regex:'.$regex],
	    'date_from'=> 'required|date|check_date_valid',
	    'date_to'=> 'required|date|check_date_to_valid:date_from',
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
			//'product_tags' => 'Product Tags',
			'price' => 'Price',
			'sale_price' => 'Sale Price',
			'date_from'=> 'Date From',
			'date_to'=> 'Date To',
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
	    //$pro->product_tags=Request::input('product_tags');
	    $pro->price=Request::input('price');
	    $pro->sale_price=Request::input('sale_price');
	    $pro->date_from=Request::input('date_from');
	    $pro->date_to=Request::input('date_to');
	    $pro->no_stock=Request::input('no_stock');
	    $pro->video=Request::input('video');
	    $pro->weight=Request::input('weight');
	    $pro->length=Request::input('length');
	    $pro->width=Request::input('width');
	    $pro->height=Request::input('height');
	    $pro->warranty=Request::input('warranty');
	    $pro->return_policy=Request::input('return_policy');
	    $pro->meta_title=Request::input('meta_title');
	    $pro->meta_description=Request::input('meta_description');
	    $pro->meta_keywords=Request::input('meta_keywords');
	    $pro->status=Request::input('status');
	    $pro->save(); 
	 $product_img = DB::table('product_images')->where('product_id', '=',Request::input('id'))->get(); 
	 $product_attr  = DB::table('product_attribute')->where('product_id', '=',Request::input('id'))->get();
	 $product_tag  = DB::table('product_attribute')->where('product_id', '=',Request::input('id'))->get();
	 
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
	    
        $tags = Request::input('tags');
	
	 if($product_tag){
			foreach($product_tag as $ktg => $vtg){
			DB::table('product_tags')->where('id', '=', $vtg->id)->delete();	    
			}
			
			if($tags){
			foreach($tags as $tk => $tv){
			ProductTags::create(['pro_tags'=> $tv['tag'],
			'product_id' => $insertedId,
			]);	    
			}	
			}
	    }
	    else{
			if($tags){
			foreach($tags as $tk => $tv){
			ProductTags::create(['pro_tags'=> $tv['tag'],
			'product_id' => $insertedId,
			]);	    
			}	
			}	    
			
	    }
	    
        $list[]='success';
        $list[]='Record is updated successfully.';	 
	return $list;
	 }
	 
	 /**********get the variation data*********/
	 public function getvariation(){
	    $vari_status = Request::input('vari_status');
	    $option_ids = Request::input('option_ids');
	    $current_val = Request::input('current_val');
	    if($current_val == 'all_vari'){
		 $newArr = array();
	    foreach($vari_status as $vsk => $vsv){
			if($vsv == 1){
			$newArr[] = $vsk;    
			}
			
	    }
	    $variations = array();
	    //print_r($option_ids);
	    foreach($option_ids as $ke => $va){
		if($va){	
			if(in_array($ke,$newArr)){
				     
			  $cat_data = DB::table('pro_option')->where('is_delete', '=','0')->where('id','=',$ke)->first();
			  $subcat_data = DB::table('pro_option')->where('is_delete', '=','0')->whereIn('id',$va)->get();
			  $main['main'] = array('name'=>$cat_data->option_name,'id'=>$ke);
			  //print_r($subcat_data);
			  $main['sub'] = $subcat_data;
			  $variations[] = $main;
			}
		}
	    } //print_r($variations);
	    
	    $return['variations'] = $variations;
	    return $return;
	    }
	    else{
		$variations = array();
		$cat_data = DB::table('pro_option')->where('is_delete', '=','0')->where('id','=',$current_val)->first();
			  $subcat_data = DB::table('pro_option')->where('is_delete', '=','0')->where('parent_id',$current_val)->get();
			  $main['main'] = array('name'=>$cat_data->option_name,'id'=>$current_val);
			  //print_r($subcat_data);
			  $main['sub'] = $subcat_data;
			  $variations[] = $main;
			  
	    $return['variations'] = $variations;
	    return $return;
	    }
	    
	 }
	 
	 public function getMainCat(){
	    
	    $vari_status = Request::input('vari_status');
	    $option_ids = Request::input('option_ids');
	    
	    $newArr = array();
	    foreach($vari_status as $vsk => $vsv){
			if($vsv == 1){
			$newArr[] = $vsk;    
			}
			
	    }
	    $main_option = array();
	    foreach($option_ids as $ke => $va){
		if($va){	
			if(in_array($ke,$newArr)){
				     
			  $cat_data = DB::table('pro_option')->where('is_delete', '=','0')->where('id','=',$ke)->first();
			  $main['main'] = array('name'=>$cat_data->option_name,'id'=>$ke);
			  $main_option[] = $main;
			}
		}
	    } //print_r($main_option);
	    
	    $return['main_option'] = $main_option;
	    return $return;
	    
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
			$product=DB::table('product')->whereRaw('FIND_IN_SET("'.$mainCategory->id.'",pro_category_id)')->get();
			//print_r($product);
			$category = array();

			$condition = 'condition';
			 $category['id'] = $mainCategory->id;

			$category['name'] = $mainCategory->category_name;
			$category['parent_id'] = $mainCategory->parent_id;
			$mainCategory->pro_count = count($product);
			$mainCategory->$condition = true;
			$mainCategory->all_category = self::getcataegorywithSub($category['id']);
			$categories[$mainCategory->id] = $category;
			//$sub = DB::table('categorys')->where('is_delete', '=','0')->where('parent_id','=',$val->id)->get();
			//$val->sub = $sub;
			//$result[$key]=$val;
			
			//$result[$key]->sub = self::getcataegorywithSub($val->id);
			
		}
		
		return $result;
	}
	public function getSubcataegoryByID($pid=0)
	{
		$categories = array();
		$result = DB::table('categorys')->where('is_delete', '=','0')->where('id','=',$pid)->get();
		
		foreach((array)$result as $key=>$mainCategory)
		{
			//$product=DB::table('product')->whereRaw('FIND_IN_SET("'.$mainCategory->id.'",pro_category_id)')->get();
			//print_r($product);
			$category = array();

			$condition = 'condition';
			 $category['id'] = $mainCategory->id;

			$category['name'] = $mainCategory->category_name;
			$category['parent_id'] = $mainCategory->parent_id;
			//$mainCategory->pro_count = count($product);
			$mainCategory->$condition = true;
			$mainCategory->all_category = self::getSubcataegoryByID($category['parent_id']);
			$categories[$mainCategory->id] = $category;
			//$sub = DB::table('categorys')->where('is_delete', '=','0')->where('parent_id','=',$val->id)->get();
			//$val->sub = $sub;
			//$result[$key]=$val;
			
			//$result[$key]->sub = self::getcataegorywithSub($val->id);
			
		}
		
		return $result;
	}
	
	
	 public function export(){
                $table = DB::table('product')->get();   
                $filename = "products.csv";
                $handle = fopen($filename, 'w+');
                fputcsv($handle, array('Product Name','Product Description','Product Short Description','Product Feature Description','Seller','Product Category','Brand','Product Tags','Price','Sale Price','No. of Stock','Length','Width','Height','Meta Title','Meta Description','Meta Keywords', 'Created At', 'Updated at'), ';');

                foreach($table as $row) {
                    
                    fputcsv($handle, array($row->pro_name, $row->pro_des, $row->pro_short_des, $row->pro_feature_des, $row->seller_id, $row->pro_category_id, $row->brand_id, $row->product_tags, $row->price, $row->sale_price, $row->no_stock, $row->length, $row->width, $row->height, $row->meta_title, $row->meta_description, $row->meta_keywords, $row->created_at, $row->updated_at), ';');
                }

                fclose($handle);
                $headers = array(
                    'Content-Type' => 'text/csv',
                );
               return Response::download($filename, 'products.csv', $headers); 
           }
	   
	   
	   public function updateDes()
	   {
	    $validator = Validator::make(Request::all(),[
            'description' => 'required',
	    'short_description' => 'required',
	    'feature_description' => 'required'
	   
	   ]);
	    
	    if ($validator->fails()) {
				$list[]='error';
				$msg=$validator->errors()->all();
				$list[]=$msg;
				return $list;
        }
	$product = Product::find(Request::input('id'));
	$product->pro_des = Request::input('description');
	$product->pro_short_des = Request::input('short_description');
	$product->pro_feature_des = Request::input('feature_description');
	$product->save();
	
	$list[]='success';
		$msgs='Record updated successfully.';
		$list[]=$msgs;
		return $list;
	   }
 }
 
?>