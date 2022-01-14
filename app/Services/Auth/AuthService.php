<?php

namespace App\Services\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a user
     * @param RegisterRequest $registerRequest
     * @return string[]
     * @throws BindingResolutionException
     */
    public function register(RegisterRequest $registerRequest)
    {
        return [
            'token' => $this->createAccessToken(
                $this->getUserModel()->create(
                    array_merge(
                        $registerRequest->only(['name', 'email']),
                        ['password' => Hash::make($registerRequest->get('password'))]
                    )
                )
            )
        ];
    }

    /**
     * Login a user
     * @param Credentials $credentials
     * @return string[]
     * @throws InvalidCredentialsException
     */
    public function login(Credentials $credentials): array
    {
        $user = $this->getUserModel()->where($this->getAuthColumn(), $credentials->getUserId())->first();
        if (is_null($user)) {
            throw new InvalidCredentialsException("Invalid credentials");
        }
        if (Hash::check($credentials->getPassword(), $user->password)) {
            return [
                'token' => $this->createAccessToken($user)
            ];
        }
        throw new InvalidCredentialsException("Invalid credentials");
    }

    /**
     * Get the User model
     * @return mixed
     * @throws BindingResolutionException
     */
    private function getUserModel()
    {
        return app()->make(User::class);
    }

    /**
     * Create access token for user
     * @param User $user
     * @return string
     */
    private function createAccessToken(User $user): string
    {
        return $user->createToken('Auth')->plainTextToken;
    }

    /**
     * Get column name for authentication
     * @return string
     */
    private function getAuthColumn()
    {
        return 'email';
    }
}
