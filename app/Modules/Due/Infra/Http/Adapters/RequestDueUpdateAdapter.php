<?php

namespace App\Modules\Due\INfra\Http\Adapters;

use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\DueItem\Infra\Http\Adapters\RequestDueItemUpdateAdapter;
use Illuminate\Http\Request;

class RequestDueUpdateAdapter extends DueUpdateData {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id') ?? $request->input('id'),
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
            filled($request->input('due_itens')) ? RequestDueItemUpdateAdapter::fromArray($request->input('due_itens')) : null,
            $request->input('created_at'),
            $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}