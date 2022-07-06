<?php

namespace SkylarkSoft\HoneyComb\Authentication\Controllers\API\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Authentication\Requests\LoginRequest;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!auth()->attempt($request->only('email', 'password'))) {

            $response = [
                'data'=> [],
                'message' => 'Unauthorized',
                'status'=> Response::HTTP_UNAUTHORIZED
            ];
            return response()->json($response,Response::HTTP_UNAUTHORIZED);
        }

        $tokenGenerate = auth()->user()->createToken('HoneyCombHR');
        $accessToken = $tokenGenerate->accessToken;

        $response = [
            'user' => auth()->user(),
            'token_type' => 'Bearer',
            'access_token' => $accessToken,
            'expires_at' => Carbon::parse(
                $tokenGenerate->token->expires_at
            )->toDateTimeString()

        ];

        return response()->json($response,Response::HTTP_OK);
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
