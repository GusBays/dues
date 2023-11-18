<?php

namespace App\Modules\DueItem\Infra\Http\Adapters;

use App\Modules\DueItem\Domain\DueItemFilter;
use Illuminate\Http\Request;

class RequestDueItemFilterAdapter extends DueItemFilter {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id') ?? $request->query('id'),
            $request->query('due_id')
        );
    }
}