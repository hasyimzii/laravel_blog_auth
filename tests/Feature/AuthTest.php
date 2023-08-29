<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // public function test_register_success(): void
    // {
    //     $response = $this->post('/api/register', [
    //         'name' => 'user',
    //         'email' => 'user@mail.com',
    //         'password' => 'secret',
    //     ]);

    //     $response->assertStatus(200)->assertJson([
    //         'data' => [
    //             'name' => 'user',
    //             'email' => 'user@mail.com',
    //         ]
    //     ]);

    //     DB::delete('delete from users order by id desc limit 1');
    //     DB::delete('delete from model_has_roles order by model_id desc limit 1');
    // }

    public function test_login_success(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin123',
        ]);

        $response->assertStatus(201)->assertJson([
            'data' => [
                'name' => 'user',
            ]
        ]);
    }

    public function test_login_error(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'admin',
        ]);

        $response->assertStatus(401)->assertJson([
            'messages' => [
                'Wrong email or password!',
            ]
        ]);
    }
}
