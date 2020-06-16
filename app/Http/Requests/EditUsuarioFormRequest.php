<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Illuminate\Routing\Route;

class EditUsuarioFormRequest extends Request
{
    protected $route;

    public function __construct(Route $route)
    {
        $this->route=$route;
    }
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
            'id_rol' => 'required',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route->parameter('usuario'),
            'password' => 'required|min:6|confirmed'
        ];
    }
}
