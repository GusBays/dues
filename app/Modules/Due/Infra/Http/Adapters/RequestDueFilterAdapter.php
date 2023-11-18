<?php

namespace App\Modules\Due\Infra\Http\Adapters;

use App\Modules\Due\Domain\DueFilter;
use Illuminate\Http\Request;

class RequestDueFilterAdapter extends DueFilter {
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id') ?? $request->query('id')
        );
    }
}