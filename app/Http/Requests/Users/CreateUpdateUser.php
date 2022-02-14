<?php

namespace App\Http\Requests\Users;

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
        $id=$this->route('id');
        return [
            'user.name'=>'required|string|min:3|max:20',
            'user.surname'=>'required|string|min:3|max:30',
            'user.email'=>'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'user.company_id'=>'integer|nullable'
        ];
    }

    public function messages()
    {
        return [
            'user.email.unique'=>"Błąd"
        ];
    }
}
