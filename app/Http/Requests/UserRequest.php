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
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric|unique:users|min:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường :attribute không được để trống',
            'email.email' => 'Định dạng email không đúng',
            'email.unique' => 'Email này đã tồn tại',
            'mobile.unique' => 'Số điện thoại đã tồn tại',
            'mobile.numeric' => 'Số điện thoại không hợp lệ',
            'mobile.min' => 'Số điện thoại không hợp lệ',
        ];
    }
}
