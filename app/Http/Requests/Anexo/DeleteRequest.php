<?php

namespace App\Http\Requests\Anexo;

use App\Models\Anexos;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
        return [
            'anexoid' => 'required'
        ];
    }

    public function attributes()
    {

         return [
            'anexoid' => 'Idendificação do Arquio',
        ];
    }
}
