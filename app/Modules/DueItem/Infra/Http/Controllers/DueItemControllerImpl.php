<?php

namespace App\Modules\DueItem\Infra\Http\Controllers;

use App\Helpers\Paginator;
use App\Modules\Due\INfra\Http\Adapters\RequestDueUpdateAdapter;
use App\Modules\DueItem\Application\DueItemServiceImpl;
use App\Modules\DueItem\Domain\DueItemController;
use App\Modules\DueItem\Domain\DueItemService;
use App\Modules\DueItem\Infra\Http\Adapters\RequestDueItemAdapter;
use App\Modules\DueItem\Infra\Http\Adapters\RequestDueItemFilterAdapter;
use App\Modules\DueItem\Infra\Http\Adapters\RequestDueItemUpdateAdapter;
use App\Modules\DueItem\Infra\Http\Resources\DueItemResource;
use App\Modules\DueItem\Infra\Http\Validators\DueItemRequestValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DueItemControllerImpl implements DueItemController {
    public function __construct(
        private DueItemServiceImpl $service
    )
    {}

    public function store(Request $request): JsonResponse {
        $validator = new DueItemRequestValidator($request);
        $validator->validate();

        $resource = $this->service->create(new RequestDueItemAdapter($request));

        return response()->json($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): JsonResponse {
        $resources = $this->service->getAll(new RequestDueItemFilterAdapter($request));

        return response()->json(
            DueItemResource::collection(resource: Paginator::paginate($resources)), Response::HTTP_OK
        );
    }

    public function show(Request $request): JsonResponse {
        $resource = $this->service->getOne(new RequestDueItemFilterAdapter($request));

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(Request $request): JsonResponse {
        $validator = new DueItemRequestValidator($request);
        $validator->validate();

        $resource = $this->service->update(new RequestDueItemUpdateAdapter($request));

        return response()->json($resource, Response::HTTP_OK);
    }

    public function destroy(Request $request): JsonResponse {
        $this->service->delete(new RequestDueItemFilterAdapter($request));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}