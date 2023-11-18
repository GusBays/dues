<?php

namespace App\Modules\Due\INfra\Db\Adapters;

use App\Modules\Due\Domain\DueFilter;

class DbDueFilterAdapter extends DueFilter {
    public function __construct(
        array $data
    )
    {
        parent::__construct(
            $data['id'] ?? null
        );
    }
}