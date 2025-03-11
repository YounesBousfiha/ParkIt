<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Mockery;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Container\Container;

class AuthTest extends TestCase
{
    #[Test]public function it_registers_a_new_user_and_returns_token()
    {
        // Arrange: Prepare the data
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123'
        ];

        // Mock the User model to simulate user creation without hitting the database
        $mockedUser = Mockery::mock('overload:' . User::class);
        $mockedUser->shouldReceive('create')
            ->once()
            ->with([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'hashed-password', // Mocked hashed password
                'role_id' => 2 // Assuming default role
            ])
            ->andReturnSelf();

        $mockedUser->shouldReceive('createToken')
            ->once()
            ->with('auth_token')
            ->andReturn(Mockery::mock(['plainTextToken' => 'token']));

        // Mock the where method
        $mockedUser->shouldReceive('where')
            ->andReturnSelf();

        // Mock the exists method
        $mockedUser->shouldReceive('exists')
            ->andReturn(false);

        // Mock the Hash facade to return a fake hashed password
        Hash::shouldReceive('make')
            ->once()
            ->with('password123')
            ->andReturn('hashed-password');

        // Mock the ResponseFactory
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')
            ->andReturnUsing(function ($data) {
                return new JsonResponse($data);
            });

        // Bind the mock to the container
        Container::getInstance()->instance(ResponseFactory::class, $responseFactory);

        // Act: Instantiate the controller and call the register method
        $controller = new AuthController();
        $request = new StoreUserRequest($userData);
        $response = $controller->register($request);

        // Assert: Verify the response contains the expected structure and values
        $responseData = $response->getData(true);
        dump($responseData);
        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertEquals('token', $responseData['token']);
        $this->assertEquals('john@example.com', $responseData['user']['email']);
    }
}
