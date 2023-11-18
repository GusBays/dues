<?php

namespace App\Modules\Due\Infra\Http\Adapters;

use App\Modules\Due\Domain\DueData;
use App\Modules\DueItem\Infra\Http\Adapters\RequestDueItemAdapter;
use Illuminate\Http\Request;

class RequestDueAdapter extends DueData {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('declarante_cpf_cnpj'),
            $request->input('declarante_razao_social'),
            $request->input('identificacao'),
            $request->input('numero'),
            $request->input('moeda'),
            $request->input('moeda'),
            $request->input('informacoes_complementares'),
            $request->input('total_vmle_moeda'),
            $request->input('total_vmcv_moeda'),
            $request->input('total_peso_liquido'),
            filled($request->input('due_itens')) ? RequestDueItemAdapter::fromArray($request->input('due_itens')) : null
        );
    }
}