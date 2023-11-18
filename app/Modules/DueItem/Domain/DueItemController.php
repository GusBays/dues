<?php

namespace App\Modules\DueItem\Domain;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface DueItemController {
    function store(Request $request): JsonResponse;
    function index(Request $request): JsonResponse;
    function show(Request $request): JsonResponse;
    function update(Request $request): JsonResponse;
    function destroy(Request $request): JsonResponse;
}