<?php

namespace App\Modules\DueItem\Infra\Http\Adapters;

use App\Modules\DueItem\Domain\DueItemUpdateData;
use Illuminate\Http\Request;

class RequestDueItemUpdateAdapter extends DueItemUpdateData {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id') ?? $request->input('id'),
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
            $request->input('created_at'),
            $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }

    /**
     * @return DueItemUpdateData[]
     */
    public static function fromArray(array $items): array {
        $toRequest = fn (array $item) => new Request($item);
        return collect($items)->map($toRequest)->mapInto(self::class)->all();
    }
}