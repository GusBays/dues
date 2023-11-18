<?php

namespace App\Modules\DueItem\Domain;

use App\Modules\DueItem\Domain\DueItemData;
use App\Traits\SetModifiedFields;

abstract class DueItemUpdateData extends DueItemData {
    use SetModifiedFields;

    public function __construct(
        private ?int $id = null,
        int $dueId = null,
        int $item = null,
        string $nfeChave = null,
        string $nfeNumero = null,
        string $nfeSerie = null,
        int $nfeItem = null,
        string $descricaoComplementar = null,
        string $ncm = null,
        float $vmleMoeda = null,
        float $vmcvMoeda = null,
        float $pesoLiquido = null,
        string $enquadramento1 = null,
        string $enquadramento2 = null,
        string $enquadramento3 = null,
        string $enquadramento4 = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    )
    {
        parent::__construct(
            $dueId,
            $item,
            $nfeChave,
            $nfeNumero,
            $nfeSerie,
            $nfeItem,
            $descricaoComplementar,
            $ncm,
            $vmleMoeda,
            $vmcvMoeda,
            $pesoLiquido,
            $enquadramento1,
            $enquadramento2,
            $enquadramento3,
            $enquadramento4
        );
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCreatedAt(): ?string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['id'] = $this->getId();
        $data['created_at'] = $this->getCreatedAt();
        $data['updated_at'] = $this->getUpdatedAt();

        return $data;
    }
}