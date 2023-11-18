<?php

namespace App\Modules\Due\Infra\Db\Interpreters;

use App\Db\DbInterpreter;
use App\Modules\Due\Domain\DueFilter;
use Illuminate\Database\Eloquent\Builder;

class DueIdInterpreter extends DbInterpreter {
    public function __construct(
        private DueFilter $filter
    )
    {}

    public function interpret(): Builder
    {
        $id = $this->filter->getId();

        if (blank($id)) return $this->query;

        return $this->query->where('id', $id);
    }
}