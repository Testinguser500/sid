<?php namespace App\Http\Controllers\Admin;
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
class PromotionController extends Controller
{      
            public function __construct()
        {
            $this->middleware('auth');
            

        }
        public function index(){
            return view('admin/promotion')->with('title','Pramotion');
        }
}       