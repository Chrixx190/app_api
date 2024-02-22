<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroStoreRequest extends FormRequest
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
                'id_est' => 'int|max:11',
                'asistencia_ad' => 'int|max:4',
                'fecha_ad' => 'date',
            ];
        } else {
            return [
                'id_est' => 'int|max:11',
                'asistencia_ad' => 'int|max:4',
                'fecha_ad' => 'date',
            ];
            
        }
    }
}
