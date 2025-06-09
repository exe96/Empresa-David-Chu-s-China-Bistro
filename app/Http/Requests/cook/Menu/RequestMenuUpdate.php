<?php
namespace App\Http\Requests\Cook\Menu;
use Illuminate\Foundation\Http\FormRequest;

class RequestMenuUpdate extends FormRequest
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

            'modal-name' => strtoupper($this->input('modal-name'))
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
            'modal-id' => 'required|integer',
            'modal-name' => 'nullable|string|regex:/^[A-Z]{2,50}$/|unique:menu_category_item,name',
            'modal-category' => 'required|string',
            'extension' => 'required|integer|exists:soported_extension,id',
            'modal-file' => 'nullable|image|mimes:png,jpg,jpeg|max:5048',
            'modal-title'=>'nullable|string|max:50',//llega hasta 255
            'modal-description'=>'nullable|string|max:255'//es tex asi que podria ser mas
        ];
    }

    public function messages(): array
    {
        return
            // Mensajes específicos para cada regla de 'name'

            [
            'name.max' => 'El nombre de la categoría no puede tener más de 50 carácteres.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras mayúsculas y debe tener entre 1 y 10 carácteres.',
            'modal-id.required' => 'El id de la categoría es obligatorio.',
            'modal-id.integer' => 'El id de la categoría debe ser un número entero.',
            'modal-name.unique' => 'Ya existe una categoría con ese nombre.',
            'modal-category.required' => 'La letra es obligatoria.',
            'modal-category.max' => 'La letra no puede tener más de 10 carácteres.',
            'modal-name.string' => 'El nombre de la categoría debe ser texto.',
            'modal-title.string' => 'El título debe ser texto.',
            'modal-title.max' => 'El título no puede tener más de 50 carácteres.',
            'modal-description.string' => 'La descripción debe ser texto.',
            'modal-description.max' => 'La descripción no puede tener más de 255 carácteres.',
            'extension.required' => 'La extensión es obligatoria.',
            'extension.integer' => 'La extensión debe ser un número entero.',
            'extension.exists' => 'La extensión seleccionada no es válida.',
            'modal-file.image' => 'El archivo debe ser una imagen.',
            'modal-file.mimes' => 'La imagen debe ser de tipo png, jpg o jpeg.',
            'modal-file.max' => 'La imagen no puede pesar más de 5 MB.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Requiere al menos uno de los campos para actualizar
            if (
                !$this->filled('modal-name') &&
                !$this->filled('modal-title') &&
                !$this->filled('modal-description') &&
                !$this->hasFile('modal-file')
            ) {
                $validator->errors()->add(
                    'error',
                    'Debes proporcionar al menos uno de los siguientes campos: nombre, título, descripción o imagen.'
                );
            }
        });
    }
}






