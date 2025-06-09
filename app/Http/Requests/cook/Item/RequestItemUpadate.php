<?php

namespace App\Http\Requests\Cook\Item;
use Illuminate\Foundation\Http\FormRequest;

class RequestItemUpadate extends FormRequest
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
            'title' => 'required|string|max:40',
            'description' => 'nullable|string|max:240',
            'price' => 'required|numeric|min:0',
            'extension' => 'required|integer|exists:soported_extension,id',
            'number' => 'required|integer',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048',
            'id' => 'required|integer|exists:item,id',
            'letter' => 'required|string|exists:menu_category_item,letter'
        ];
    }






    public function messages(): array
    {
        return [
            'title.required' => 'El título del item es obligatorio.',
            'title.max' => 'El título no puede tener más de 40 carácteres.',
            'title.string' => 'El título debe ser un texto.',
            'description.string' => 'La descripción debe ser un texto.',
            'description.max' => 'La descripción no puede tener más de 240 carácteres.',
            'price.required' => 'El precio del item es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'extension' => 'Ocurrio un error al validar la extensión del item.',
            'number' => 'Ocurrio un error al validar el número del item.',
            'img.image' => 'La imagen debe ser un archivo de imagen.',
            'img.mimes' => 'La imagen debe ser de tipo png, jpg o jpeg.',
            'img.max' => 'La imagen no puede pesar más de 5 MB.',
            'id.required' => 'El ID del item es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El ID seleccionado no es válido.',
            'letter.required' => 'La letra del item es obligatoria.',



        ];
    }
}



