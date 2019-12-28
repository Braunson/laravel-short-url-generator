<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetrieveURLFormRequest extends FormRequest
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
            'hash' => 'required|exists:urls,hash' . $this->hash,
        ];
    }
}
