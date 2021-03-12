<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RunTypesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function the_run_types_page_contains_the_intermittent_runs_table_component()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/training/run-types')
           ->assertSeeLivewire('training.run-types.intermittent-runs-table');
    }

    /** @test */
    public function the_run_types_page_contains_the_steady_runs_table_component()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/training/run-types')
           ->assertSeeLivewire('training.run-types.steady-runs-table');
    }

    /** @test */
    public function the_run_types_page_contains_the_progressive_runs_table_component()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/training/run-types')
           ->assertSeeLivewire('training.run-types.progressive-runs-table');
    }

}
