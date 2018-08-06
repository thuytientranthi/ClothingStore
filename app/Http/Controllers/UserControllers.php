<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use DB;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisteredValidate;
use Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\User; 
use App\Http\Controllers\destroy;


class UserControllers extends Controller
{
	protected $category;

	public function __construct()
	{
		$this->category = Category::all();
	}

	public function getIndex(){
		$category = Category::all();
	    $product = DB::table('product')->orderBy('id','desc')->get();
		return view('pages.home', compact('category', 'product'));
	}

    public function showProduct(){
	    $category = Category::all();
	    $product_id = DB::table('product')->select('id','name','price','id_category as idCategory','describe','image')->orderBy('id','desc')->get();
	    return view('pages.product', compact('category', 'product_id'));
	}
	public function showProducInCategory($idCategory){
		// $category = Category::all();
		// $product_id = DB::table('product')
  //       				->join('category', function ($join) use ($idCategory) {
  //           				$join->on('product.id_category', '=', 'category.id')
  //           				->where('product.id_category' , $idCategory);
  //       					})->toSql();

		$product_id = DB :: table('product')->select('product.*','category.id as idCategory')
						->join ('category','category.id','=','product.id_category')
						->where (['product.id_category'=> $idCategory])
						->get();
		 // dd($product_id);
		return view('pages.product', [ 'product_id' => $product_id, 'category' => $this->category ]);
	}

	// public function getDetail($id_product,$idCategory){
	// 	$category = Category::all();
	// 	$detail = DB::table('product')
	// 	            ->join('detail', 'product.id', '=', 'detail.id_product')
	// 	            ->join('size', 'size.id', '=', 'detail.id_size')
	// 	            ->select('product.*', 'size.name', 'detail.quantity')
	// 	            ->where('product.id','=',$id_product)
	// 	            ->get();
 //        $sameCategory = DB::table('product')
	// 				->where('id_category','=', $idCategory)
	// 				->whereNotExists(function ($query) use ($id_product) {
	// 	                $query->select('id')
	// 	                ->where('id', '=', $id_product);
	// 	            })->get();

	// $sameCategory = DB::table('product')
	// 				->where('id_category','=', $idCategory)
	// 				->whereNotExists(function ($query) use ($idProduct) {
	// 	                $query->select('id')
	// 	                ->where('id', '=', $idProduct);
	// 	            })->get();
	        // foreach ($detail as $key => &$value) {
	        // 	$value->size = explode(',', $value->size);
	        // }
 //        //dd($detail);
 //        return view('pages.detail',compact('detail','sameCategory','category'));
	// }

	public function getDetail($id_product,$idCategory){
			$category = Category::all();
			$sameCategory = DB::table('product')
					->where('id_category','=', $idCategory)
					->whereNotExists(function ($query) use ($id_product) {
		                $query->select('id')
		                ->where('id', '=', $id_product);
		            })->get();
		            // dd($id_product);
			$detail =  DB::table('category')
						->join('product','product.id_category','=','category.id')
						->join('detail', 'product.id', '=', 'detail.id_product')
						->join('size', 'size.id', '=', 'detail.id_size')
						->where('product.id', '=', $id_product )
				        ->select('product.*','category.name as nameCategory', DB::raw("group_concat(size.name) as size"))->groupBy('product.id')->get();
			//dd($detail);
	        return view('pages.detail',compact('detail','sameCategory','category'));
	}

	public function shop(){
		$category = Category::all();
		$pages = DB::table('product')->paginate(1);
		$recommended = Product::inRandomOrder()->limit(2)->get();
		return view('pages.shop',compact('category','recommended','pages'));
	}
	public function test($id){
		$test = Product::select('name')->where('id', '=', $id)->get();
		// dd($test);
		return view('pages.test',compact('test'));
	}

	public function search(Request $request){
		$category = Category::all();
		$key = $request->key;
		$search = Product::where('name','like','%'.$key.'%')->get();			

		return view ('pages.search',compact('search','category'));
	}

	

    public function showRegistered(){
    	$category = Category::all();
    	return view('pages.registered',compact('category'));
    }
    public function getRegistered(RegisteredValidate $request){
    	$category = Category::all();
    	$username = DB::table('users')->select('*')->where('username','=',$request->get('username'))->get();

    	if(count($username) ==0) {
    		$user = new User([
    				'name'=>$request->get('name'),
    				'phone'=>$request->get('phone'),
    				'birthday'=>$request->get('birthday'),
    				'username'=>$request->get('username'),
    				'level'=>'2',
    				'password' =>Hash::make( $request->get('password'))
    			]);
    		$user->save();
    		Session::flash('success', 'Đăng ký thành viên thành công!');
    		return view('pages.registered',compact('category'));
    	}else{
    		Session::flash('error','Username này đã tồn tại, bạn vui lòng nhập username khác');
    		return view('pages.registered',compact('category'));
    	}
    }

    public function showLogin(){
		$category = Category::all();
		if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
        	return view('pages.home',compact('category'));
        } else {
            return view('pages.login',compact('category'));
        }
	}
	public function login(LoginRequest $request){
		$category = Category::all();
		// $product = DB::table('product')->orderBy('id','desc')->get();
		// $user = $request->username;
		// $pass = $request->password;
		// $sql = DB::table('users')->where([['username', '=',$user],['password','=',$pass]])->get();
		// if(count($sql) == 1){
		// 	return view('pages.home',compact('category','product'));
		// }else{
		// 	 return back();
		// }

		$product = DB::table('product')->orderBy('id','desc')->get();
		$login = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($login)) {
            return view('pages.home',compact('category','product'));
        }else {
            return redirect(compact('product','category'))->back()->with('status', 'Email hoặc Password không chính xác');
        }
	}

	public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }	

    public function cart() {
    	$category = Category::all();
	    return view('pages.cart',compact('category'));
	}
	public function addToCart(Request $request,$id){
		$product = Product::where('id', $id)->first();
		$cart = (Session::get('cart'));
		//dd(Session::get('cart'));
		if($request->quantity){
			$qty= $request->quantity;
			// dd($qty);
		}else{
			$qty =1;
		}
		if (Session::has('cart')) {
			$id_session = array_column(Session::get('cart'), 'id');
				//dd($id_session);
			$check = array_search($id, $id_session);
			//dd($check);
			if($check !== false) {
			 	$qty = $cart[$id]['qty'] + $qty;
			}
		}
		$cart[$id]= [
	        "id" => $product->id,
	        "describe" => $product->describe,
	        "name" => $product->name,
	        "price" => $product->price,
	        "image" => $product->image,
	        "qty" => $qty,
       	];
		Session::put('cart', $cart);
		return redirect()->back();	
	}
	public function updateCart(Request $request,$id){
		// dd($request->update);
	
		$qty = $request->input();
		unset($qty['_token']);
		$cart = Session::get('cart');
		foreach ($qty as $key => $value) {
			$cart[$key]['qty'] = $value;
		}
		Session::put('cart', $cart);
		return redirect()->back();
		
	}
	public function removeCart($id){
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
        return back();
	}
	public function deleteCart(){
		$cart = Session::get('cart');
      	Session::flush($cart);
        return back();
	}
	
}
