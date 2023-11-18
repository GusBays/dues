<?php

namespace App\Modules\DueItem\Infra\Http\Resources;

use App\Modules\DueItem\Domain\DueItemUpdateData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DueItemResource extends JsonResource {
    public function toArray(Request $request): array
    {
        /** @var DueItemUpdateData $this */
        return [
            'id' => $this->getId(),
            'due_id' => $this->getDueId(),
            'item' => $this->getItem(),
            'nfe_chave' => $this->getNfeChave(),
            'nfe_numero' => $this->getNfeNumero(),
            'nfe_serie' => $this->getNfeSerie(),
            'nfe_item' => $this->getNfeItem(),
            'descricao_complementar' => $this->getDescricaoComplementar(),
            'ncm' => $this->getNcm(),
            'vmle_moeda' =>  number_format($this->getVmleMoeda(), 2, ',', '.'),
            'vmcv_moeda' => number_format($this->getVmcvMoeda(), 2, ',', '.'),
            'peso_liquido' => number_format($this->getPesoLiquido(), 2, ',', '.'),
            'enquadramento1' => $this->getEnquadramento1(),
            'enquadramento2' => $this->getEnquadramento2(),
            'enquadramento3' => $this->getEnquadramento3(),
            'enquadramento4' => $this->getEnquadramento4(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}