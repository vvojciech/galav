<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImageRequest extends Request
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
            'title' => 'required|min:3',
            'upload_file' => 'required|mimes:jpeg,bmp,png|between:0,10240', // 10MB (10240kB)
//            'upload_file' => 'required|between:0,10240', // 10MB (10240kB)
        ];
    }
}