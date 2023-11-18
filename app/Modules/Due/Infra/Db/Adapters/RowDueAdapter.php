<?php

namespace App\MOdules\Due\Infra\Db\Adapters;

use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\Due\Infra\Db\Models\Due;
use App\Modules\DUeItem\Infra\Db\Adapters\RowDueItemAdapter;

class RowDueAdapter extends DueUpdateData {
    public function __construct(
        Due $row
    )
    {
        parent::__construct(
            id: $row->id,
            declaranteCpfCnpj: $row->declarante_cpf_cnpj,
            declaranteRazaoSocial: $row->declarante_razao_social,
            identificacao: $row->identificacao,
            numero: $row->numero,
            moeda: $row->moeda,
            incoterm: $row->incoterm,
            informacoesComplementares: $row->informacoes_complementares,
            totalVmleMoeda: $row->total_vmle_moeda,
            totalVmcvMoeda: $row->total_vmcv_moeda,
            totalPesoLiquido: $row->total_peso_liquido,
            items: filled($row->dueItems) ? RowDueItemAdapter::fromArray($row->dueItems) : null,
            createdAt: $row->created_at,
            updatedAt: $row->updated_at
        );
    }
}