<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ManifiestoFormRequest extends Request
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
            'id_vehiculo'=>'required',
            'id_user'=>'required',
            'valor'=>'required',
            'id_cabecera'=>'required',
        ];
    }
}
