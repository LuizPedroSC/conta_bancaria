<?php

namespace App\Services;

use App\Classes\Helpers\ScriptCaseDataHelper;
use Illuminate\Http\Response;

class ResponseService
{

    public function successResponse($message)
    {
        return response()->json(['message' => $message], Response::HTTP_OK);
    }

    public function errorResponse($message, $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}