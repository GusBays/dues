<?php

namespace App\Modules\Views\Infra\Http\Controllers;

use App\Modules\Due\Application\DueServiceImpl;
use App\Modules\Due\Domain\DueData;
use App\Modules\Due\INfra\Db\Adapters\DbDueFilterAdapter;
use App\Modules\Due\Infra\Http\Controllers\DueControllerImpl;
use App\Modules\Due\Infra\Http\Resources\DueResource;
use App\Modules\DueItem\Application\DueItemServiceImpl;
use App\Modules\DueItem\Infra\Http\Resources\DueItemResource;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class ViewControllerImpl {
    public function __construct(
        private DueControllerImpl $dueController,
        private DueItemServiceImpl $dueItemService
    )
    {}

    public function home(Request $request): View
    {
        return view('home');
    }

    public function dueList(Request $request): View
    {
        /** @var LengthAwarePaginator */
        $paginator = $this->dueController
            ->index($request)
            ->getOriginalContent()
            ->resource;

        $toArray = fn (DueResource $item) => $item->toArray($request);
        $duesArr = collect($paginator->items())->map($toArray);

        return view('due-list', ['dues' => $duesArr]);
    }

    public function due(Request $request): View
    {
        /** @var DueResource */
        $due = $this->dueController
            ->show($request)
            ->getOriginalContent();

        $data = $due->toArray($request);
        $itemsToArray = fn (DueItemResource $item) => $item->toArray($request);
        $data['due_items'] = collect($data['due_items'])->map($itemsToArray)->all();

        return view('due', ['due' => $data]);
    }

    public function newDue(Request $request): View
    {
        return view('due-new');
    }
}