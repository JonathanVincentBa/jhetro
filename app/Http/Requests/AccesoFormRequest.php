<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccesoFormRequest extends Request
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
            'id_user'=>'required',
            'ip_client'=>'required',
            'date'=>'required|date',
            'condicion'=>'required'
        ];
    }
}
