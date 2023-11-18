<?php

namespace App\Modules\DueItem\Infra\Db\Interpreters;

use App\Db\DbInterpreter;
use App\Modules\DueItem\Domain\DueItemFilter;
use Illuminate\Database\Eloquent\Builder;

class DueItemDueIdInterpreter extends DbInterpreter {
    public function __construct(
        private DueItemFilter $filter
    )
    {}
    
    public function interpret(): Builder
    {
        $dueId = $this->filter->getDueId();

        if (blank($dueId)) return $this->query;

        return $this->query->where('due_id', $dueId);
    }
}