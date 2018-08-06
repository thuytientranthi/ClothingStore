<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Category;
use App\Models\Product;
use DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
        //  return view('pages.home',compact('category','product'));
        // }else{
        //   return back();
        // }

        $product = DB::table('product')->orderBy('id','desc')->get();
        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $remember = false;
        if(isset($request->remember)){
            $remember = $request->remember;
        }
        if (Auth::attempt($login,$remember)) {
            return view('pages.home',compact('category','product'));
        }else {
            return redirect(compact('product','category'))->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
