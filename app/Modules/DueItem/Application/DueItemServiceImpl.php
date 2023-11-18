<?php

namespace App\Modules\DueItem\Application;

use App\Modules\DueItem\Domain\DueItemData;
use App\Modules\DueItem\Domain\DueItemFilter;
use App\Modules\DueItem\Domain\DueItemRepository;
use App\Modules\DueItem\Domain\DueItemService;
use App\Modules\DueItem\Domain\DueItemUpdateData;
use App\Modules\DueItem\Infra\Db\DueItemRepositoryDb;

class DueItemServiceImpl implements DueItemService {
    public function __construct(
        private DueItemRepositoryDb $repository
    )
    {}

    public function create(DueItemData $data): DueItemUpdateData {
        return $this->repository->create($data);
    }


    public function getAll(DueItemFilter $filter): array {
        return $this->repository->getAll($filter);
    }

    public function getOne(DueItemFilter $filter): DueItemUpdateData {
        return $this->repository->getOne($filter);
    }

    public function update(DueItemUpdateData $data): DueItemUpdateData {
        return $this->repository->update($data);
    }

    public function delete(DueItemFilter $filter): void {
        $this->repository->delete($filter);
    }
}