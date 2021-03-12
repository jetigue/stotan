<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainingDashboardTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function dashboard_contains_a_link_to_macrocycles()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get('/training/macrocycles');

        $response->assertStatus(200);
    }

    /** @test */
    public function dashboard_contains_a_link_to_run_types()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/training/run-types');

        $response->assertStatus(200);
    }

}
