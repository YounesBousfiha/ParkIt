<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;
use Mockery;

class AuthTest extends TestCase
{
    public function test_it_registers_a_new_user_and_returns_token()
    {
        // Arrange: Prepare the data to be used in the request
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123'
        ];

        // Mock the User model to simulate its behavior
        $mockedUser = Mockery::mock(User::class);
        $mockedUser->shouldReceive('create')
            ->once()
            ->with([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'hashed-password',
                'role_id' => 2
            ])
            ->andReturnSelf();

        $mockedUser->shouldReceive('createToken')
            ->once()
            ->with('auth_token')
            ->andReturn(Mockery::mock(['plainTextToken' => 'fake-token']));

        // Mock the Hash facade
        Hash::shouldReceive('make')
            ->once()
            ->with('password123')
            ->andReturn('hashed-password');


        // Act: Call the register method on the controller
        $controller = new AuthController();
        $response = $controller->register(new StoreUserRequest($userData));

        // Assert: Check that the response contains the user and token
        $this->assertArrayHasKey('user', $response->getData(true));
        $this->assertArrayHasKey('token', $response->getData(true));
        $this->assertEquals('fake-token', $response->getData(true)['token']);
    }
}
