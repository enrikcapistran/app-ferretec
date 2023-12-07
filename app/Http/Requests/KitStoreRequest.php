<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'productos' => 'array', // Adjust based on your requirements
            'productos.*' => 'exists:productos,idProducto', // Ensure each producto exists in the productos table
        ];
    }
}
