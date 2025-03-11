<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_with_correct_creds() {
        $data = [
            'email' => 'user@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
            ->assertJson([
                'token' => true]
            );
    }

    public function test_login_with_incorrect_creds() {
        $data = [
            'email' => 'unknown@gmail.com',
            'password' => 'incorrectpass'
            ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(401)
            ->assertJson([
                'message' => true
            ]);
    }

    public function test_login_with_email_only () {
        $data = [
            'email' => 'user@gmail.com',
            'password' => ''
        ];

        $response = $this->postJson('api/login', $data);

        $response->assertStatus(422);
    }

    public function test_login_with_password_only () {
        $data = [
            'email' => '',
            'password' => '123456'
        ];

        $response = $this->postJson('api/login', $data);

        $response->assertStatus(422);
    }

    public function test_login_with_malformed_email() {
        $data = [
            'email' => 'hellogmail.com',
            'password' => '12345678'
        ];

        $response = $this->postJson('api/login', $data);

        $response->assertStatus(422);
    }

    public function test_register_with_valide_data() {
        $data = [
          'name' => 'Younes Tester',
          'email' => 'tester@gmail.com',
          'password' => '123456789'
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(201)
            ->assertJson([
                'token' => true
            ]);
    }

    public function test_register_already_exist_user() {
        $data = [
            'name' => 'Younes Tester',
            'email' => 'tester@gmail.com',
            'password' => '123456789'
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(400)
            ->assertJson([
                'message' => true
            ]);
    }

    public function test_register_with_malformed_email () {
        $data = [
            'name' => 'younes younes',
            'email' => 'younesgmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(422);
    }

    public function test_register_empty_email () {
        $data = [
            'name' =>'younes younes',
            'email' => '',
            'password' => '123456'
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(422);
    }

    public function test_register_empty_name () {
        $data = [
            'name' => '',
            'email' => 'younes@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(422);
    }

    public function test_register_empty_password() {
        $data = [
            'name' => 'ayoub l kha2ine',
            'email' => 'ayoub@gmail',
            'password' => ''
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(422);
    }

    public function test_register_with_empty_fields() {
        $data = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];

        $response = $this->postJson('api/register', $data);

        $response->assertStatus(422);
    }

    public function test_logout_with_correct_token() {
        $data = [
            'email' => 'user@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/login', $data);

        $token = $response['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];

        $logoutResponse = $this->withHeaders($headers)->postJson('api/logout', $data);

        $logoutResponse->assertStatus(200);
    }

    public function test_logout_with_incorrect_token() {
        $response = $this->postJson('api/logout');

        $response->assertStatus(401);
    }
}

