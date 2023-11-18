<?php

namespace App\Modules\Due\Infra\Http\Resources;

use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\DueItem\Domain\DueItemUpdateData;
use App\Modules\DueItem\Infra\Http\Resources\DueItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DueResource extends JsonResource {
    public function toArray(Request $request): array
    {
        /** @var DueUpdateData $this */
        return [
            'id' => $this->getId(),
            'declarante_cpf_cnpj' => $this->getDeclaranteCpfCnpj(),
            'declarante_razao_social' => $this->getDeclaranteRazaoSocial(),
            'identificacao' => $this->getIdentificacao(),
            'numero' => $this->getNumero(),
            'moeda' => $this->getMoeda(),
            'incoterm' => $this->getIncoterm(),
            'informacoes_complementares' => $this->getInformacoesComplementares(),
            'total_vmle_moeda' => number_format($this->getTotalVmleMoeda(), 2, ',', '.'),
            'total_vmcv_moeda' => number_format($this->getTotalVmcvMoeda(), 2, ',', '.'),
            'total_peso_liquido' => number_format($this->getTotalPesoLiquido(), 2, ',', '.'),
            'due_items' => DueItemResource::collection($this->getItems()),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}