<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AulasStoreRequest extends FormRequest
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
                'nombre_al' => 'string|max:50',
            ];
        } else {
            return [
                'nombre_al' => 'string|max:50',
            ];
            
        }
    }


    public function messages()
    {
        if(request()->isMethod('post')){
            return[
              'nombre_al.required' => 'El Aula es requerida'
            ];
         }else{
             return[
                 'nombre_al.required' => 'El Aula es requerida'
            ];
         }
    }


}
