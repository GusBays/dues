<?php

namespace App\Modules\DueItem\Infra\Db\Models;

use App\Modules\Due\Infra\Db\Models\Due;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DueItem extends Model {
    /** @var string[] */
    protected $fillable = [
        'due_id',
        'item',
        'nfe_chave',
        'nfe_numero',
        'nfe_serie',
        'nfe_item',
        'descricao_complementar',
        'ncm',
        'vmle_moeda',
        'vmcv_moeda',
        'peso_liquido',
        'enquadramento1',
        'enquadramento2',
        'enquadramento3',
        'enquadramento4',
    ];

    public function due(): BelongsTo {
        return $this->belongsTo(Due::class);
    }
}
