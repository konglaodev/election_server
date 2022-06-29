<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class villageNumberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->villageNo ? $this->villageNo->id : null;
        return [
            'number' => $id
                ? "required|max:190|unique:village_numbers,number,$id"
                : 'required|max:190|unique:village_numbers,number'
        ];
    }
}
