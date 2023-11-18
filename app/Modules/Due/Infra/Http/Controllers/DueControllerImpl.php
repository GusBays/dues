<?php

namespace App\Modules\Due\Infra\Http\Controllers;

use App\Helpers\Paginator;
use App\Modules\Due\Application\DueServiceImpl;
use App\Modules\Due\Domain\DueController;
use App\Modules\Due\Domain\DueUpdateData;
use App\Modules\Due\Infra\Http\Adapters\RequestDueAdapter;
use App\Modules\Due\Infra\Http\Adapters\RequestDueFilterAdapter;
use App\Modules\Due\INfra\Http\Adapters\RequestDueUpdateAdapter;
use App\Modules\Due\Infra\Http\Resources\DueResource;
use App\Modules\Due\Infra\Http\Validators\DueRequestValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DueControllerImpl implements DueController {
    public function __construct(
        private DueServiceImpl $service
    )
    {}

    public function store(Request $request): JsonResponse {
        $validator = new DueRequestValidator($request);
        $validator->validate();

        $resource = $this->service->create(new RequestDueAdapter($request));

        return response()->json(new DueResource($resource), Response::HTTP_CREATED);
    }

    public function index(Request $request): JsonResponse {
        $resources = $this->service->getAll(new RequestDueFilterAdapter($request));

        return response()->json(
            DueResource::collection(resource: Paginator::paginate($resources)), Response::HTTP_OK
        );
    }

    public function show(Request $request): JsonResponse {
        $resource = $this->service->getOne(new RequestDueFilterAdapter($request));

        return response()->json(new DueResource($resource), Response::HTTP_OK);
    }

    public function update(Request $request): JsonResponse {
        $validator = new DueRequestValidator($request);
        $validator->validate();

        $resource = $this->service->update(new RequestDueUpdateAdapter($request));

        return response()->json(new DueResource($resource), Response::HTTP_OK);
    }

    public function destroy(Request $request): JsonResponse {
        $this->service->delete(new RequestDueFilterAdapter($request));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}