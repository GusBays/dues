<?php

namespace App\Modules\DueItem\Infra\Db;

use App\Modules\DueItem\Domain\DueItemData;
use App\Modules\DueItem\Domain\DueItemFilter;
use App\Modules\DueItem\Domain\DueItemRepository;
use App\Modules\DueItem\Domain\DueItemUpdateData;
use App\Modules\DueItem\Infra\Db\Adapters\DbDueItemFilterAdapter;
use App\Modules\DUeItem\Infra\Db\Adapters\RowDueItemAdapter;
use App\Modules\DueItem\Infra\Db\Interpreters\DueItemDueIdInterpreter;
use App\Modules\DueItem\Infra\Db\Interpreters\DueItemIdInterpreter;
use App\Modules\DueItem\Infra\Db\Models\DueItem;
use Illuminate\Database\Eloquent\Builder;

class DueItemRepositoryDb implements DueItemRepository {
    public function __construct(
        private DueItem $model
    )
    {}

    public function create(DueItemData $data): DueItemUpdateData
    {
        $dueItem = $this->model->fill($data->toArray());

        $dueItem->save();

        return new RowDueItemAdapter($dueItem);
    }

    /**
     * @return DueItemUpdateData[]
     */
    public function getAll(DueItemFilter $filter): array
    {
        $dueItems = $this->getDueItemQuery($filter)
            ->get()
            ->mapInto(RowDueItemAdapter::class)
            ->all();

        return $dueItems;
    }

    public function getOne(DueItemFilter $filter): DueItemUpdateData
    {
        $dueItem = $this->getDueItemQuery($filter)->firstOrFail();

        return new RowDueItemAdapter($dueItem);
    }

    public function update(DueItemUpdateData $data): DueItemUpdateData
    {
        $dueItem = $this->getDueItemQuery(
            new DbDueItemFilterAdapter(['id' => $data->getId()])
        )->firstOrFail();

        $dueItem->update($data->onlyModifiedData());

        return new RowDueItemAdapter($dueItem);
    }

    public function delete(DueItemFilter $filter): void
    {
        $dueItem = $this->getDueItemQuery($filter)->firstOrFail();

        $dueItem->delete();
    }

    private function getDueItemQuery(DueItemFilter $filter): Builder
    {
        $query = $this->model->query();

        $interpreters = [
            new DueItemIdInterpreter($filter),
            new DueItemDueIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreters) {
            $interpreters->setQuery($query)->interpret();
        }

        return $query;
    }
}