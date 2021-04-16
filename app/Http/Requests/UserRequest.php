<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages() {
        return [
            'name.required' => 'Tên không được trống',
            'email.required' => 'Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
