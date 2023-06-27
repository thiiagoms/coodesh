<?php

namespace App\Http\Controllers\Coodesh;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Response};

class CoodeshController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['message' => 'REST Back-end Challenge 20201209 Running'], Response::HTTP_OK);
    }
}
