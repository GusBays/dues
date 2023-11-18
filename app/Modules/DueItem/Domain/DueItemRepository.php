<?php

namespace App\Modules\DueItem\Domain;

interface DueItemRepository {
    function create(DueItemData $data): DueItemUpdateData;
    /** @return DueItemUpdateData[] */
    function getAll(DueItemFilter $filter): array;
    function getOne(DueItemFilter $filter): DueItemUpdateData;
    function update(DueItemUpdateData $data): DueItemUpdateData;
    function delete(DueItemFilter $filter): void;
}