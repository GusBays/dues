<?php

namespace App\Modules\DueItem\Domain;

use Illuminate\Contracts\Support\Arrayable;

abstract class DueItemData implements Arrayable {
    public function __construct(
        private ?int $dueId = null,
        private ?int $item = null,
        private ?string $nfeChave = null,
        private ?string $nfeNumero = null,
        private ?string $nfeSerie = null,
        private ?int $nfeItem = null,
        private ?string $descricaoComplementar = null,
        private ?string $ncm = null,
        private ?float $vmleMoeda = null,
        private ?float $vmcvMoeda = null,
        private ?float $pesoLiquido = null,
        private ?string $enquadramento1 = null,
        private ?string $enquadramento2 = null,
        private ?string $enquadramento3 = null,
        private ?string $enquadramento4 = null
    )
    {}

    public function getDueId(): ?int {
        return $this->dueId;
    }

    public function setDueId(int $dueId): self {
        $this->dueId = $dueId;

        return $this;
    }

    public function getItem(): ?int {
        return $this->item;
    }

    public function getNfeChave(): ?string {
        return $this->nfeChave;
    }

    public function getNfeNumero(): ?string {
        return $this->nfeNumero;
    }

    public function setNfeNumero(string $nfeNumero): self {
        $this->nfeNumero = $nfeNumero;

        return $this;
    }

    public function getNfeSerie(): ?string {
        return $this->nfeSerie;
    }

    public function setNfeSerie(string $nfeSerie): self {
        $this->nfeSerie = $nfeSerie;

        return $this;
    }

    public function getNfeItem(): ?string {
        return $this->nfeItem;
    }

    public function getDescricaoComplementar(): ?string {
        return $this->descricaoComplementar;
    }

    public function getNcm(): ?string {
        return $this->ncm;
    }

    public function getVmleMoeda(): ?float {
        return $this->vmleMoeda;
    }

    public function getVmcvMoeda(): ?float {
        return $this->vmcvMoeda;
    }

    public function getPesoLiquido(): ?float {
        return $this->pesoLiquido;
    }

    public function getEnquadramento1(): ?string {
        return $this->enquadramento1;
    }

    public function getEnquadramento2(): ?string {
        return $this->enquadramento2;
    }

    public function getEnquadramento3(): ?string {
        return $this->enquadramento3;
    }

    public function getEnquadramento4(): ?string {
        return $this->enquadramento4;
    }

    public function toArray(): array
    {
        return [
            'due_id' => $this->getDueId(),
            'item' => $this->getItem(),
            'nfe_chave' => $this->getNfeChave(),
            'nfe_numero' => $this->getNfeNumero(),
            'nfe_serie' => $this->getNfeSerie(),
            'nfe_item' => $this->getNfeItem(),
            'descricao_complementar' => $this->getDescricaoComplementar(),
            'ncm' => $this->getNcm(),
            'vmle_moeda' => $this->getVmleMoeda(),
            'vmcv_moeda' => $this->getVmcvMoeda(),
            'peso_liquido' => $this->getPesoLiquido(),
            'enquadramento1' => $this->getEnquadramento1(),
            'enquadramento2' => $this->getEnquadramento2(),
            'enquadramento3' => $this->getEnquadramento3(),
            'enquadramento4' => $this->getEnquadramento4()
        ];
    }
}