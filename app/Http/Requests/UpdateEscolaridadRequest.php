<?php

namespace Roscio\Http\Requests;

use Roscio\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdateEscolaridadRequest extends Request
{
    public function __construct(Route $route)
    {
        $this->route = $route;
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
            'escolaridad' => 'required|unique:escolaridades,escolaridad,' . $this->route->getParameter('escolaridades')
        ];
    }
}
