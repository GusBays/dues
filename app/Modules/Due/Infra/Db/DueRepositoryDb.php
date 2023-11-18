<?php

namespace App\Modules\Due\Infra\Db;

use App\Modules\Due\Domain\DueData;
use App\Modules\Due\Domain\DueFilter;
use App\Modules\Due\Domain\DueRepository;
use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\Due\INfra\Db\Adapters\DbDueFilterAdapter;
use App\MOdules\Due\Infra\Db\Adapters\RowDueAdapter;
use App\Modules\Due\Infra\Db\Interpreters\DueIdInterpreter;
use App\Modules\Due\Infra\Db\Models\Due;
use App\Modules\DueItem\Application\DueItemServiceImpl;
use App\Modules\DueItem\Domain\DueItemData;
use Illuminate\Database\Eloquent\Builder;

class DueRepositoryDb implements DueRepository {
    private const RELATIONS = ['dueItems'];

    public function __construct(
        private Due $model,
        private DueItemServiceImpl $dueItemService
    )
    {}

    public function create(DueData $data): DueUpdateData
    {
        $itemsCollection = collect($data->getItems());

        $toGetVmleMoeda = fn (DueItemData $item) => $item->getVmleMoeda();
        $totalVmleMoeda =$itemsCollection->map($toGetVmleMoeda)->sum();

        $toGetVmcvMoeda = fn (DueItemData $item) => $item->getVmcvMoeda();
        $totalVmcvMoeda = $itemsCollection->map($toGetVmcvMoeda)->sum();

        $toGetPesoLiquido = fn (DueItemData $item) => $item->getPesoLiquido();
        $totalPesoLiquido = $itemsCollection->map($toGetPesoLiquido)->sum();

        $data
            ->setTotalVmleMoeda($totalVmleMoeda)
            ->setTotalVmcvMoeda($totalVmcvMoeda)
            ->setTotalPesoLiquido($totalPesoLiquido);

        $due = $this->model->fill($data->toArray());

        $due->save();

        $setNfeSerie = fn (DueItemData $item) => $item->setNfeSerie(substr($item->getNfeChave(), 22, 3));
        $setNfeNumero = fn (DueItemData $item) => $item->setNfeNumero(substr($item->getNfeChave(), 25, 9));
        $setDueId = fn (DueItemData $item) => $item->setDueId($due->id);
        $toArray = fn (DueItemData $item) => $item->toArray();
        $formattedItems = $itemsCollection
            ->each($setNfeSerie)
            ->each($setNfeNumero)
            ->each($setDueId)
            ->map($toArray);
    
        $due->dueItems()->createMany($formattedItems);

        return new RowDueAdapter($due);
    }

    /**
     * @return DueData[]
     */
    public function getAll(DueFilter $filter): array
    {
        $dues = $this->getDueQuery($filter)
            ->get()
            ->mapInto(RowDueAdapter::class)
            ->all();

        return $dues;
    }

    public function getOne(DueFilter $filter): DueUpdateData
    {
        $due = $this->getDueQuery($filter)->firstOrFail();

        return new RowDueAdapter($due);
    }

    public function update(DueUpdateData $data): DueUpdateData
    {
        $due = $this->getDueQuery(
            new DbDueFilterAdapter(['id' => $data->getId()])
        )->firstOrFail();

        $due->update($data->onlyModifiedData());

        return new RowDueAdapter($due);
    }

    public function delete(DueFilter $filter): void
    {
        $due = $this->getDueQuery($filter)->firstOrFail();

        $due->delete();
    }

    private function getDueQuery(DueFilter $filter): Builder
    {
        $query = $this->model->query();

        $interpreters = [
            new DueIdInterpreter($filter)
        ];

        foreach($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}