<?php

namespace App\Modules\DueItem\Infra\Http\Adapters;

use App\Modules\DueItem\Domain\DueItemData;
use Illuminate\Http\Request;

class RequestDueItemAdapter extends DueItemData {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('due_id'),
            $request->input('item'),
            $request->input('nfe_chave'),
            $request->input('nfe_numero'),
            $request->input('nfe_serie'),
            $request->input('nfe_item'),
            $request->input('descricao_complementar'),
            $request->input('ncm'),
            $request->input('vmle'),
            $request->input('vmcv'),
            $request->input('peso_liquido'),
            $request->input('enquadramento1'),
            $request->input('enquadramento2'),
            $request->input('enquadramento3'),
            $request->input('enquadramento4'),
        );
    }

    /**
     * @return DueItemData[]
     */
    public static function fromArray(array $items): array {
        $toRequest = fn (array $item) => new Request($item);
        return collect($items)->map($toRequest)->mapInto(self::class)->all();
    }
}