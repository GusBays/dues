<?php

namespace App\Modules\DueItem\Infra\Db\Adapters;

use App\Modules\DueItem\Domain\DueItemFilter;

class DbDueItemFilterAdapter extends DueItemFilter {
    public function __construct(
        array $data
    )
    {
        parent::__construct(
            $data['id'] ?? null,
            $data['dueId'] ?? null
        );
    }
}