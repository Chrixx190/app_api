<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroAsistenciaStoreRequest extends FormRequest
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
                'id_est' => 'int',
                'asistencia_ad' => 'int',
                'id_registro_persona'=> 'int'
            ];
        } else {
            return [
                'id_est' => 'int',
                'asistencia_ad' => 'int',
                'id_registro_persona'=> 'int'
            ];
            
        }
    }
}
