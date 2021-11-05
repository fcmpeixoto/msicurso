<?php

namespace App\Http\Requests\Curso;

use App\Models\Cursos;
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
        return Cursos::$rules;
    }

    public function attributes()
    {
        return [
            'txtnomecurso'       => 'Nome do Curso',
            'txtdescricaocurso'  => 'Descrição do Curso',
            'txtvalorcurso'      => 'Valor do Curso',
            'txtdatainicio'      => 'Data do Início do Curso',
            'txtdatafim'         => 'Data do Fim do Curso',
            'txtquantidadecurso' => 'Quantidade de Inscritos',
        ];
    }
}
