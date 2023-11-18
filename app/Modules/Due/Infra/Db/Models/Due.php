<?php

namespace App\Modules\Due\Infra\Db\Models;

use App\Modules\DueItem\Infra\Db\Models\DueItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Due extends Model {
    /** @var string[] */
    protected $fillable = [
        'id',
        'declarante_cpf_cnpj',
        'declarante_razao_social',
        'identificacao',
        'numero',
        'moeda',
        'incoterm',
        'informacoes_complementares',
        'total_vmle_moeda',
        'total_vmcv_moeda',
        'total_peso_liquido'
    ];

    public function dueItems(): HasMany {
        return $this->hasMany(DueItem::class, 'due_id', 'id');
    }
}