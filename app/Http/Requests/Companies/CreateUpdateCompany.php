<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCompany extends FormRequest
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
            'company.name'=>'required|string|min:5|max:30',
            'company.compressed_name'=>'required|string|min:2|max:10',
            'company.description'=>'required|string|min:5',
        ];
    }

}
