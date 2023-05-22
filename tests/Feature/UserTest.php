<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_users_are_displayed_on_dashboard_page(): void
    {
        $users = User::factory(10)->create();

        $response = $this
            ->actingAs($users[0])
            ->get('/dashboard');

        $response->assertSee($users[0]->name);
        $response->assertSee($users[1]->name);
        $response->assertSee($users[0]->email);
        $response->assertSee($users[1]->email);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);

        $response = $this->actingAs($user)->delete("/users/{$user->id}");

        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);

        $response->assertRedirect('/dashboard');
    }
}
