<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GuiaFormRequest extends Request
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
        'id_motivo_traslado'=>'required',
        'id_forma_pago'=>'required',
        'id_persona'=>'required',
        'ciudad_origen'=>'required|max:45',
        'ciudad_destino'=>'required|max:45',
        'nom_remitente'=>'required|max:50',
        'dni_remitente'=>'required|max:20',
        'direccion_remitente'=>'required|max:500',
        'fono_remitente'=>'required|max:10',
        'nom_destinatario'=>'required|max:50',
        'dni_destinatario'=>'max:20',
        'direccion_destinatario'=>'max:500',
        'fono_destinatario'=>'max:10',
        'num_guia'=>'required|unique:cabecera,num_guia',
        'num_guia_trans'=>'unique:cabecera,num_guia_trans',
        'flete'=>'required',
        'valor_guia'=>'required',
        'prima'=>'required',
        'cantidad'=>'required',
        'descripcion'=>'required',
        'v_unitario'=>'required',
        'v_parcial'=>'required',
        ];
    }
}
