<?php
namespace App\Http\Requests\Cook\Item;
use Illuminate\Foundation\Http\FormRequest;

class RequestItemCreate extends FormRequest
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
            'letter' => 'required|string|exists:menu_category_item,letter',
            'number' => 'required|integer|min:1',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048'
        ];
    }






    public function messages(): array
    {
        return [
            'title.required' => 'El título del item es obligatorio.',
            'title.string' => 'El título debe ser un texto.',
            'title.max' => 'El título no puede tener más de 40 carácteres.',
            'description.string' => 'La descripción debe ser un texto.',
            'description.max' => 'La descripción no puede tener más de 240 carácteres.',
            'price.required' => 'El precio del item es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'extension.required' => 'La extensión del item es obligatoria.',
            'extension.integer' => 'La extensión debe ser un número entero.',
            'extension.exists' => 'La extensión seleccionada no es válida.',
            'letter.required' => 'La letra del item es obligatoria.',
            'letter.string' => 'La letra debe ser un texto.',
            'letter.exists' => 'La letra seleccionada no es válida.',
            'number.required' => 'El número del item es obligatorio.',
            'number.integer' => 'El número debe ser un número entero.',
            'img.image' => 'La imagen debe ser un archivo de imagen.',
            'img.mimes' => 'La imagen debe ser de tipo png, jpg o jpeg.',
            'img.max' => 'La imagen no puede pesar más de 5 MB.'
        ];
    }
}
