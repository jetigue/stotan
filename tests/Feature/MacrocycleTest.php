<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\Training\Macrocycle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MacrocycleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_macrocycle()
    {
        $team = Team::factory()->create(['id'=> 2]);

        $user = User::factory()->create(['team_id' => $team->id]);

        Livewire::test('training.macrocycle-form')
            ->set('name', 'Macrocycle Name')
            ->set('begin_date_for_editing', '01/01/2020')
            ->set('end_date_for_editing', '10/10/2020')
            ->set('team_id', 1)
            ->call('submitForm');

            $this->assertTrue(Macrocycle::whereName('Macrocycle Name')->exixts());
    }

}
