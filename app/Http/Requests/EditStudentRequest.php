<?php

namespace Roscio\Http\Requests;

use Roscio\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditStudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

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
            'ci' => 'required|unique:students,ci,' . $this->route->getParameter('students')
        ];
    }
}
