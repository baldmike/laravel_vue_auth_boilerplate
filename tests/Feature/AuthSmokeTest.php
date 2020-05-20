<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthSmokeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::where('email', 'email@example.com')->first();

        $data = [
            'grant_type' => 'password',
            'email' => trim($user->email),
            'password' => 'password',
            'scope' => '',
        ];

        // hit API, assert login
        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(200);
    }
}
