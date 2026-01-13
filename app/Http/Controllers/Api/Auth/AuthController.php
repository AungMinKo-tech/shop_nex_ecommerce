<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use ApiResponse, HasApiTokens, HasFactory, Notifiable;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/[0-9]/|regex:/[a-zA-Z]/',
            'confirmPassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        try {
            $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

            $refreshToken = Str::random(64);

            $user->update([
                'refresh_token' => hash('sha256', $refreshToken),
                'refresh_token_expires_at' => Carbon::now()->addDays(15),
            ]);

            $content = [
                'user' => $user,
                'accessToken' => $accessToken,
            ];

            return $this->successResponse('Login success', new AuthResource($content), 200)->withCookie(cookie(
                'refreshToken',
                $refreshToken,
                60 * 24 * 15,
                '/',
                null,
                app()->isLocal() ? false : true,
                true,
                false,
                'Strict'
            ));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/[0-9]/|regex:/[a-zA-Z]/',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->errorResponse('Your credentials have not served!', 404);
        }

        if (!Hash::check($validatedData['password'], $user->password)) {
            return $this->errorResponse('Your credential is wrong!', 401);
        }

        try {
            $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

            $refreshToken = Str::random(64);

            $user->update([
                'refresh_token' => hash('sha256', $refreshToken),
                'refresh_token_expires_at' => Carbon::now()->addDays(15),
            ]);

            $content = [
                'user' => $user,
                'accessToken' => $accessToken,
            ];

            return $this->successResponse('Login success', new AuthResource($content), 200)->withCookie(cookie(
                'refreshToken',  // cookie name
                $refreshToken,  // cookie value
                60 * 24 * 15,  // minutes (15 days)
                '/',  // path
                null,  // domain
                app()->isLocal() ? false : true,  // secure => local false
                true,  // httpOnly
                false,  // raw
                'Strict'  // SameSite           // SameSite option (Strict / Lax / None)
            ));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->cookie('refreshToken');

        if (!$refreshToken) {
            return $this->errorResponse('Refresh token not found', 401);
        }

        $hashed = hash('sha256', $refreshToken);

        $user = User::where('refresh_token', $hashed)
            ->where('refresh_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return $this->errorResponse('Invalid refresh token', 401);
        }

        $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

        $content = [
            'user' => $user,
            'accessToken' => $accessToken,
        ];

        return $this->successResponse('successful', new AuthResource($content), 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->update([
            'refresh_token' => null,
            'refresh_token_expires_at' => null,
        ]);

        $forgetCookie = cookie()->forget('refreshToken');

        return response()->json(['message' => 'Logged out'])->withCookie($forgetCookie);
    }
}
