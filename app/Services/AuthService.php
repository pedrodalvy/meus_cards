<?php


namespace App\Services;


use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuthService
{
    public function gerarToken(Request $request)
    {
        if (!$token = auth()->attempt($request->all())) {
            throw new AuthenticationException(Lang::get('auth.failed'));
        }

        return $this->retornoComToken($token);
    }

    protected function retornoComToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function atualizarToken()
    {
        return $this->retornoComToken(auth()->refresh());
    }

    public function invalidarToken()
    {
        auth()->logout();
    }
}