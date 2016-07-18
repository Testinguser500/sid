<?php namespace App\Http\Controllers\Admin;
use App\User; 
use DB;
use Input;
use Crypt;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Controllers\cart\Cart;
use Session;
class HomeAppController extends Controller
{
	public function index(){           
             return view('admin/login');
		
	}
        
 }
 
?>