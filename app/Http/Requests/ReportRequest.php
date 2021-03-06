<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportRequest extends Request
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
            'report_reason_id' => 'required|exists:report_reasons,id',
        ];
    }
}
