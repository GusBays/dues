<?php

namespace App\Modules\Due\Domain;

interface DueService {
    function create(DueData $data): DueUpdateData;
    /** @return DueUpdateData[] */
    function getAll(DueFilter $filter): array;
    function getOne(DueFilter $filter): DueUpdateData;
    function update(DueUpdateData $data): DueUpdateData;
    function delete(DueFilter $filter): void;
}