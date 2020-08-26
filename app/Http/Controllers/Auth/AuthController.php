<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api')->except('login');
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            return $this->authService->gerarToken($request);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function refresh()
    {
        try {
            return $this->authService->atualizarToken();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function logout()
    {
        try {
            $this->authService->invalidarToken();
            return response()->noContent();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}