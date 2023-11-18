<?php

namespace App\Modules\Due\Infra\Http\Validators;

use App\Http\Validators\RequestValidator;

class DueRequestValidator extends RequestValidator {
    public function getRules(): array
    {
        return [
            'declarante_cpf_cnpj' => 'required|string|max:14',
            'declarante_razao_social' => 'required|string|max:255',
            'identificacao' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'moeda' => 'required|digits_between:1,10',
            'incoterm' => 'required|string|max:3',
            'informacoes_complementares' => 'nullable|string',
            'total_vmle_moeda' => 'nullable|decimal:17,2',
            'total_vmcv_moeda' => 'nullable|decimal:17,2',
            'total_peso_liquido' => 'nullable|decimal:17,5'
        ];
    }
}