<?php

namespace App\Http\Requests\Anexo;

use App\Models\Anexos;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Anexos::$rules;
    }

    public function attributes()
    {

         return [
            'txtnomeanexo' => 'Nome do Arquio',
            'txtanexo'     => 'Arquivo',
        ];
    }
}
