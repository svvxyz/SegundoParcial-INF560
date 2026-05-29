<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoria_id' => [
                'required',
                'exists:categorias,id'
            ],

            'nombre' => [
                'required',
                'string',
                'max:150'
            ],

            'sku' => [
                'required',
                Rule::unique('productos')->ignore($this->producto)
            ],

            'precio' => [
                'required',
                'numeric',
                'min:0'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'disponible' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',

            'nombre.required' => 'Debe ingresar un nombre para el producto.',

            'precio.required' => 'Debe ingresar un precio.',
            'precio.numeric' => 'El precio ingresado debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',

            'stock.required' => 'Debe indicar la cantidad en stock.',
            'stock.integer' => 'La cantidad de stock debe ser un número entero.',
            'stock.min' => 'El stock no puede tener valores negativos.',

            'sku.required' => 'El código SKU es obligatorio.',
            'sku.unique' => 'Ya existe un producto con ese SKU.'
        ];
    }
}