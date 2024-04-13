<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministradoresStoreRequest extends FormRequest
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
                'email_ad' => 'string|max:80',
                'password_ad' => 'string|max:250',
                'nombre_ad' => 'string|max:100',
                'apellido_ad' => 'string|max:100',
                'cargo_ad' => 'string|max:25',
                'rol_ad' => 'string|max:20',
                'modulo_1' => 'string|max:40',
                'modulo_2' => 'string|max:40',
                'modulo_3' => 'string|max:40',
            ];
        } else {
            return [
                'email_ad' => 'string|max:80',
                'password_ad' => 'string|max:250',
                'nombre_ad' => 'string|max:100',
                'apellido_ad' => 'string|max:100',
                'cargo_ad' => 'string|max:25',
                'rol_ad' => 'string|max:20',
                'modulo_1' => 'string|max:40',
                'modulo_2' => 'string|max:40',
                'modulo_3' => 'string|max:40',
            ];
            
        }
    }
}
