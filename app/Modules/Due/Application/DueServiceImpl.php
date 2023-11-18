<?php

namespace App\Modules\Due\Application;

use App\Modules\Due\Domain\DueData;
use App\Modules\Due\Domain\DueFilter;
use App\Modules\Due\Domain\DueRepository;
use App\Modules\Due\Domain\DueService;
use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\Due\Infra\Db\DueRepositoryDb;

class DueServiceImpl implements DueService {
    public function __construct(
        private DueRepositoryDb $repository
    ) {}

    public function create(DueData $data): DueUpdateData {
        return $this->repository->create($data);
    }

    public function getAll(DueFilter $filter): array {
        return $this->repository->getAll($filter);
    }

    public function getOne(DueFilter $filter): DueUpdateData {
        return $this->repository->getOne($filter);
    }

    public function update(DueUpdateData $data): DueUpdateData {
        return $this->repository->update($data);
    }

    public function delete(DueFilter $filter): void {
        $this->repository->delete($filter);
    }
}