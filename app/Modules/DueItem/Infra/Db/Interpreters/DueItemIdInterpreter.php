<?php

namespace App\Modules\DueItem\Infra\Db\Interpreters;

use App\Db\DbInterpreter;
use App\Modules\DueItem\Domain\DueItemFilter;
use Illuminate\Database\Eloquent\Builder;

class DueItemIdInterpreter extends DbInterpreter {
    public function __construct(
        private DueItemFilter $filter
    )
    {}
    
    public function interpret(): Builder
    {
        $id = $this->filter->getId();

        if (blank($id)) return $this->query;

        return $this->query->where('id', $id);
    }
}