<?php

namespace App\Modules\DueItem\Infra\Http\Validators;

use App\Http\Validators\RequestValidator;

class DueItemRequestValidator extends RequestValidator {
    public function getRules(): array
    {
        return [
            'due_id' => 'required|integer|exists:dues,id',
            'item' => 'required|integer|max:11',
            'nfe_chave' => 'required|string|max:44',
            'nfe_numero' => 'nullable|string|max:9',
            'nfe_serie' => 'nullable|string|max:3',
            'nfe_item' => 'required|integer|max:11',
            'descricao_complementar' => 'required|string',
            'ncm' => 'required|string|max:8',
            'vmle_moeda' => 'required|decimal:17,2',
            'vmcv_moeda' => 'required|decimal:17,2',
            'peso_liquido' => 'required|decimal:17,5',
            'enquadramento1' => 'nullable|string|max:5',
            'enquadramento2' => 'nullable|string|max:5',
            'enquadramento3' => 'nullable|string|max:5',
            'enquadramento4' => 'nullable|string|max:5',
        ];
    }
}