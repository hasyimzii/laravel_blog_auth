<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    // date('D, d M Y H:i')
    // date('Y-m-d H:i')

    // Register
    public function test_register_success(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'user',
                'email' => 'user@mail.com',
                'role' => 'user',
            ]
        ]);
    }

    public function test_register_error(): void
    {
        $response = $this->post('/api/register', [
            'name' => null,
            'email' => null,
            'password' => null,
        ]);

        $response->assertStatus(400)->assertJson([
            'messages' => [
                'name required!',
                'email required!',
                'password required!',
            ]
        ]);
    }

    public function test_register_existed(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(400)->assertJson([
            'messages' => [
                'email already registered!',
            ]
        ]);
    }

    // Login
    public function test_login_success(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin123',
        ]);

        $response->assertStatus(201)->assertJson([
            'data' => [
                'name' => 'admin',
                'role' => 'admin',
                'authorization' => [
                    'type' => 'bearer',
                ],
            ]
        ]);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereType('data.authorization.token', 'string');
        });
    }

    public function test_login_error(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin',
        ]);

        $response->assertStatus(401)->assertJson([
            'messages' => [
                'wrong email or password!',
            ]
        ]);
    }

    // Get User
    public function test_get_user_success(): void
    {
        $token = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin123',
        ])->decodeResponseJson()['data']['authorization']['token'];

        $response = $this->get('/api/user', $headers = [
            'Authorization' => 'Bearer '. $token,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'admin',
                'role' => 'admin',
                'authorization' => [
                    'type' => 'bearer',
                ],
            ]
        ]);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereType('data.authorization.token', 'string');
        });
    }
    
    public function test_get_user_error(): void
    {
        $response = $this->post('/api/user', $headers = [
            'Authorization' => '',
        ]);

        $response->assertStatus(401)->assertJson([
            'messages' => [
                'you are unauthorized!',
            ]
        ]);
    }

    // Logout
    public function test_logout_success(): void
    {
        $token = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin123',
        ])->decodeResponseJson()['data']['authorization']['token'];

        $response = $this->post('/api/logout', $headers = [
            'Authorization' => 'Bearer '. $token,
        ]);

        $response->assertStatus(200)->assertJson([
            'messages' => [
                'logout success!',
            ]
        ]);
    }

    public function test_logout_error(): void
    {
        $response = $this->post('/api/logout', $headers = [
            'Authorization' => '',
        ]);

        $response->assertStatus(401)->assertJson([
            'messages' => [
                'you are unauthorized!',
            ]
        ]);
    }
}
