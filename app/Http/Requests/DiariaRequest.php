<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiariaRequest extends FormRequest
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
        $rules = [
            'data_diaria'    => 'date',
            'inicio_jornada' => 'nullable|date_format:"H:i:s"',
            'fim_jornada'    => 'nullable|date_format:"H:i:s"',
            'inicio_almoco'  => 'nullable|date_format:"H:i:s"',
            'fim_almoco'     => 'nullable|date_format:"H:i:s"',
            'observacoes'    => 'nullable|string',
        ];

        if ($this->getMethod() == 'POST') {
            $rules['data_diaria'] = 'required|date';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'data_diaria'    => 'Data da Diária',
            'inicio_jornada' => 'Início da Jornada',
            'fim_jornada'    => 'Fim da Jornada',
            'inicio_almoco'  => 'Início Almoço',
            'fim_almoco'     => 'Fim Almoço',
            'observacoes'    => 'Observações',
        ];
    }
}
