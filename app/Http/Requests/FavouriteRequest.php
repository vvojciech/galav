<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FavouriteRequest extends Request
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
            'filename' => 'required',  // @todo check if it exists + check implications on performance
            'action' => 'in:add,remove'
        ];
    }
}
