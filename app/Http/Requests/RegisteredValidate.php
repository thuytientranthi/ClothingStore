<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|alpha_num|min:9|max:13',
            'birthday' => 'required|date|before:-18 years',
            'username' => 'required|email',
            'password' => 'required|min:8|max:50'
        ];
    }
      public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ vè tên',
            'name.string' => 'Vui lòng nhập đúng định dạng của họ và tên',
            'phone.alpha_num' => 'Vui lòng nhập đúng định dạng của số điện thoại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Số điện thoại phải tối thiểu có 9 kí tự',
            'phone.max' => 'Số điện thoại phải tối đa 13 kí tự',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
            'birthday.date' => 'Vui lòng nhập đúng định dạng ngày',
            'birthday.before' => 'Bạn phải đủ 18 tuổi mới có thể đăng ký',
            'username.required' => 'Vui lòng nhập email',
            'username.email' => 'Vui lòng nhập đúng địng dạng email',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Password phải có tối thiếu 8 kí tự'
        ];
    }
}
