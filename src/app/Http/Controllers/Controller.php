<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public const SUCCESS_RESPONSE = 200;
    public const CREATED_RESPONSE = 201;
    public const FAILURE_RESPONSE = 422;
    public const NOTFOUND_RESPONSE = 404;
    public const ERR_VALIDATION_RESPONSE = 400;

    public const SUCCESS_MESSAGE = true;
    public const FAILURE_MESSAGE = false;

    public function successResponse($data = null, $errors = null, $pagination = null, $message = null)
    {
        return response()->json([
            'status' => Controller::SUCCESS_RESPONSE,
            'errors' => $errors,
            'data' => $data,
            'message' => $message,
            'pagination' => $pagination,
        ], 200);
    }

    public function failureResponse($errors = null, $message = null)
    {
        return response()->json([
            'status' => Controller::FAILURE_RESPONSE,
            'message' => $message,
            'errors' => $errors,
        ], 200);
    }

    public function notFoundResponse($errors = null)
    {
        return response()->json([
            'status' => Controller::NOTFOUND_RESPONSE,
        ], 200);
    }


    public function errValidationResponse($errors = null)
    {
        return response()->json([
            'status' => Controller::ERR_VALIDATION_RESPONSE,
            'errors' => $errors,
        ], 422);
    }

    public function response(int $status, string $message, $data = null, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
