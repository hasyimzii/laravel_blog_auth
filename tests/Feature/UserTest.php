<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_login_success(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_failed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
