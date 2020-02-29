<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchItemRequest extends FormRequest
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
            'sid' => 'required|integer|min:0',
            'group' => 'required|integer|min:0',
            'page' => 'integer|min:0',
        ];
    }
}
