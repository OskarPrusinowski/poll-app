<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateUser extends FormRequest
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
            'user.name'=>'required|string|min:3|max:20',
            'user.surname'=>'required|string|min:3|max:30',
            'user.login'=>'required|string|min:5|max:15',
            'user.email'=>'required|email',
            'user.password'=>'required|confirmed|min:8|max:20',
            'user.company_id'=>'integer'
        ];
    }
}
