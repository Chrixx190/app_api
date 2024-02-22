<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudiantesStoreRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                'nombre_es' => 'string|max:150',
                'id_aulas' => 'int|max:15'
            ];
        } else {
            return [
                'nombre_es' => 'string|max:150',
                'id_aulas' => 'int|max:15'
            ];
            
        }
    }
}
