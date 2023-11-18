<?php

namespace App\Modules\DUeItem\Infra\Db\Adapters;

use App\Modules\DueItem\Domain\DueItemUpdateData;
use App\Modules\DueItem\Infra\Db\Models\DueItem;
use Illuminate\Database\Eloquent\Collection;

class RowDueItemAdapter extends DueItemUpdateData {
    public function __construct(
        DueItem $row
    )
    {
        parent::__construct(
            id: $row->id,
            dueId: $row->due_id,
            item: $row->item,
            nfeChave: $row->nfe_chave,
            nfeNumero: $row->nfe_numero,
            nfeSerie: $row->nfe_serie,
            nfeItem: $row->nfe_item,
            descricaoComplementar: $row->descricao_complementar,
            ncm: $row->ncm,
            vmleMoeda: $row->vmle_moeda,
            vmcvMoeda: $row->vmcv_moeda,
            pesoLiquido: $row->peso_liquido,
            enquadramento1: $row->enquadramento1,
            enquadramento2: $row->enquadramento2,
            enquadramento3: $row->enquadramento3,
            enquadramento4: $row->enquadramento4
        );
    }

    /**
     * @param DueItem[]
     */
    public static function fromArray(array | Collection $items): array {
        return collect($items)->mapInto(self::class)->all();
    }
}