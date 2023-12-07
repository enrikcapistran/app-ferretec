<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioSucursalesStoreRequest extends FormRequest
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
            'idSucursal' => 'required|exists:sucursales,idSucursal',
            'idProducto' => 'required|exists:productos,idProducto',
            'existencia' => 'required|integer|min:0',
            'stockMaximo' => 'required|integer|min:0',
            'stockMinimo' => 'required|integer|min:0',
            'idStatus' => 'required|exists:status,idStatus',
        ];
    }
}
