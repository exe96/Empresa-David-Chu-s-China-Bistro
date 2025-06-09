<?php
namespace App\Http\Requests\Cook\Menu;
use Illuminate\Foundation\Http\FormRequest;

class RequestMenuDelete extends FormRequest
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
        return      [
            'id' => 'required|integer|exists:menu_category_item,id',
            'letter' => 'required|string|regex:/^[A-Z]{1,10}$/|exists:menu_category_item,letter',
        ];
    }

     public function messages(): array
    {
        return
            // Mensajes específicos para cada regla
            [
            'id.required' => 'El id de la categoría es obligatorio.',
            'id.integer' => 'El id de la categoría debe ser un número entero.',
            'id.exists' => 'La categoría con el id proporcionado no existe.',
            'letter.required' => 'La letra es obligatoria.',
            'letter.regex' => 'La letra solo puede contener letras mayúsculas y debe tener entre 1 y 10 carácteres.',
        ];

    }
}

