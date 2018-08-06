<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisteredValidate;
use App\Models\Category;
use App\Models\Product;
use DB;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

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
}
