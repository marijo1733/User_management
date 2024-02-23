<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

  
        public function test_a_user_can_view_users()
        {
            $user = User::factory()->create();
            $this->actingAs(User::factory()->create(), 'api');
            $response = $this->json('GET', 'api/auth/index');
     
            $response->assertStatus(200);
        }

    public function test_a_user_can_update_a_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs(User::factory()->create(), 'api');

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            
            '_method' => 'PUT'
        ];

        $response = $this->json('POST', 'api/auth/update/'.$user->id, $attributes);

        $response->assertStatus(200);
    }

}