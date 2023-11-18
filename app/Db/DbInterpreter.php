<?php

namespace App\Db;

use Illuminate\Database\Eloquent\Builder;

abstract class DbInterpreter {
    protected Builder $query;

    public function setQuery(Builder $query): self {
        $this->query = $query;

        return $this;
    }

    abstract function interpret(): Builder;
}