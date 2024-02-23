<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $res_array = (array)json_decode($response->content());

        $this->assertArrayHasKey('access_token', $res_array);
        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'xxxxxxxxxxxxxxxxxx',
        ]);

        $response->assertStatus(302);
    }

    public function test_only_existing_users_can_login(): void
    {

        $response = $this->post('/login', [
            'email' => 'fake@email.com',
            'password' => 'xxxxxxxxxxxxxxxxxx',
        ]);

        $response->assertStatus(302);
    }

}