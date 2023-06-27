<?php

namespace App\Http\Controllers\Launch;

use App\Http\Controllers\Controller;
use App\Services\LaunchService;
use Illuminate\Http\{JsonResponse, Request, Response};

class LaunchController extends Controller
{
    /**
     * @param LaunchService $launchService
     */
    public function __construct(private LaunchService $launchService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()
            ->json(['results' => $this->launchService->index()], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json($this->launchService->store($request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return response()->json(['results' => $this->launchService->show($uuid)], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        return response()->json($this->launchService->update($uuid, $request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        return response()->json($this->launchService->destroy($uuid), Response::HTTP_NO_CONTENT);
    }
}
