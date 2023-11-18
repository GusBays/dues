<?php

namespace App\Modules\Due\Domain;

use App\Modules\DueItem\Domain\DueItemData;
use Illuminate\Contracts\Support\Arrayable;

abstract class DueData implements Arrayable {
    public function __construct(
        private ?string $declaranteCpfCnpj = null,
        private ?string $declaranteRazaoSocial = null,
        private ?string $identificacao = null,
        private ?string $numero = null,
        private ?int $moeda = null,
        private ?string $incoterm = null,
        private ?string $informacoesComplementares = null,
        private ?int $totalVmleMoeda = null,
        private ?int $totalVmcvMoeda = null,
        private ?int $totalPesoLiquido = null,
        /** @var DueItemData[] */
        private ?array $items = null
    ) 
    {}

    public function getDeclaranteCpfCnpj(): ?string {
        return $this->declaranteCpfCnpj;
    }

    public function getDeclaranteRazaoSocial(): ?string {
        return $this->declaranteRazaoSocial;
    }

    public function getIdentificacao(): ?string {
        return $this->identificacao;
    }

    public function getNumero(): ?string {
        return $this->numero;
    }

    public function getMoeda(): ?int {
        return $this->moeda;
    }

    public function getIncoterm(): ?string {
        return $this->incoterm;
    }

    public function getInformacoesComplementares(): ?string {
        return $this->informacoesComplementares;
    }

    public function getTotalVmleMoeda(): ?int {
        return $this->totalVmleMoeda;
    }

    public function setTotalVmleMoeda(int $totalVmleMoeda): self {
        $this->totalVmleMoeda = $totalVmleMoeda;

        return $this;
    }

    public function getTotalVmcvMoeda(): ?int {
        return $this->totalVmcvMoeda;
    }

    public function setTotalVmcvMoeda(int $totalVmcvMoeda): self {
        $this->totalVmcvMoeda = $totalVmcvMoeda;

        return $this;
    }

    public function getTotalPesoLiquido(): ?int {
        return $this->totalPesoLiquido;
    }

    public function setTotalPesoLiquido(int $totalPesoLiquido): self {
        $this->totalPesoLiquido = $totalPesoLiquido;

        return $this;
    }

    /**
     * @return DueItemData[]
     */
    public function getItems(): ?array {
        return $this->items;
    }

    public function toArray(): array
    {
        $itemsToArray = fn (DueItemData $item) => $item->toArray();
        if (filled($this->getItems())) $items = collect($this->getItems())->map($itemsToArray);
        else $items = null;

        return [
            'declarante_cpf_cnpj' => $this->getDeclaranteCpfCnpj(),
            'declarante_razao_social' => $this->getDeclaranteRazaoSocial(),
            'identificacao' => $this->getIdentificacao(),
            'numero' => $this->getNumero(),
            'moeda' => $this->getMoeda(),
            'incoterm' => $this->getIncoterm(),
            'informacoes_complementares' => $this->getInformacoesComplementares(),
            'total_vmle_moeda' => $this->getTotalVmleMoeda(),
            'total_vmcv_moeda' => $this->getTotalVmCvMoeda(),
            'total_peso_liquido' => $this->getTotalPesoLiquido(),
            'due_items' => $items
        ];
    }
}