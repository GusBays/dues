<?php

namespace App\Modules\Due\Domain;

use App\Traits\SetModifiedFields;

abstract class DueUpdateData extends DueData {
    use SetModifiedFields;

    public function __construct(
        private ?int $id = null,
        string $declaranteCpfCnpj = null,
        string $declaranteRazaoSocial = null,
        string $identificacao = null,
        string $numero = null,
        int $moeda = null,
        string $incoterm = null,
        string $informacoesComplementares = null,
        int $totalVmleMoeda = null,
        int $totalVmcvMoeda = null,
        int $totalPesoLiquido = null,
        array $items = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    )
    {
        parent::__construct(
            $declaranteCpfCnpj,
            $declaranteRazaoSocial,
            $identificacao,
            $numero,
            $moeda,
            $incoterm,
            $informacoesComplementares,
            $totalVmleMoeda,
            $totalVmcvMoeda,
            $totalPesoLiquido,
            $items
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