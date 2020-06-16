<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmpresaFormRequest extends Request
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
            'razon_social'=>'required|max:100',
            'ruc'=>'required|max:45',
            'direccion'=>'required|max:100',
            'telefono'=>'required|numeric',
            'email'=>'required|email',
            'representante'=>'required|max:100',
            'logo'=> 'mimes:jpeg,bmp,png'
        ];
    }
}
