<?php
namespace App\Http\Requests\Cook\Menu;
use Illuminate\Foundation\Http\FormRequest;

class RequestMenuCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'letter' => strtoupper($this->input('letter')),
            'name' => strtoupper($this->input('name'))
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return      [
            'name' => 'required|string|regex:/^[A-Z]{2,50}$/|unique:menu_category_item,name',
            'letter' => 'required|string|regex:/^[A-Z]{1,10}$/|unique:menu_category_item,letter',
            'extension' => 'required|integer|exists:soported_extension,id',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048',
            'title'=>'required|string|max:50',//llega hasta 255
            'description'=>'nullable|string|max:255'//es tex asi que podria ser mas
        ];
    }

     public function messages(): array
    {
        return /* [
            // Mensaje genérico para cualquier error de 'name'
            'name' => 'El campo nombre de la categoría no es válido.',
            */
            // Mensajes específicos para cada regla de 'name'
            [
            'name.regex' => 'El nombre de la categoría solo puede contener letras mayúsculas y debe tener entre 2 y 50 carácteres.',
            'name.max' => 'El nombre de la categoría no puede tener más de 50 carácteres.',
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.string' => 'El nombre de la categoría debe ser texto.',
            'letter.regex' => 'La letra solo puede contener letras.',
            'letter.required' => 'La letra es obligatoria.',
            'letter.max' => 'La letra no puede tener más de 10 carácteres.',
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser texto.',
            'title.max' => 'El título no puede tener más de 50 carácteres.',
            'description.string' => 'La descripción debe ser texto.',
            'description.max' => 'La descripción no puede tener más de 255 carácteres.',
            'extension.required' => 'La extensión es obligatoria.',
            'extension.integer' => 'La extensión debe ser un número entero.',
            'extension.exists' => 'La extensión seleccionada no es válida.',
            'img.image' => 'El archivo debe ser una imagen.',
            'img.mimes' => 'La imagen debe ser de tipo png, jpg o jpeg.',
            'img.max' => 'La imagen no puede pesar más de 5 MB.'
        ];

    }
}

