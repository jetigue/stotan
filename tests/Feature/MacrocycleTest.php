<?php

namespace Tests\Feature;

use App\Http\Livewire\Training\Macrocycles\MacrocycleCard;
use App\Http\Livewire\Training\Macrocycles\MacrocycleForm;
use App\Models\Team;
use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MacrocycleTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function the_macrocycles_page_contains_the_proper_breadcrumbs()
    {

        $response = $this->actingAs(User::factory()->create())->get('/training');

        $response->assertStatus(200);

    }

    /** @test  */
    public function the_macrocycles_page_contains_the_proper_header()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/training/macrocycles');

        $response->assertSeeText("Training Cycles");
    }

    /** @test */
    public function the_macrocycles_page_contains_the_macrocycle_form()
    {
         $this->actingAs(User::factory()->create());

         $this->get('/training/macrocycles')
            ->assertSeeLivewire('training.macrocycles.macrocycle-form');
    }

    /** @test */
    public function page_contains_the_macrocycle_card_if_the_end_date_is_in_the_future()
    {
         $this->actingAs(User::factory()->create());

         $futureDate = Carbon::today()->addDay()->format('Y-m-d');

         $macrocycle = Macrocycle::factory()->create([
             'begin_date' => '2021-01-01',
             'end_date' => $futureDate
         ]);

         $this->get('/training/macrocycles')
            ->assertSeeLivewire('training.macrocycles.macrocycle-card');
    }

    /** @test */
    public function page_does_not_contains_the_macrocycle_card_if_the_end_date_is_in_the_past()
    {
         $this->actingAs(User::factory()->create());

         $pastDate = Carbon::today()->subDay()->format('Y-m-d');

         $macrocycle = Macrocycle::factory()->create([
             'begin_date' => '2021-01-01',
             'end_date' => $pastDate
         ]);

         $this->get('/training/macrocycles')
            ->assertDontSee('training.macrocycles.macrocycle-card');
    }

    /** @test */
    public function a_user_can_create_a_macrocycle()
    {

        $this->actingAs(User::factory()->create(['team_id' => 4]));

        Livewire::test(MacrocycleForm::class)
            ->set('name', 'Macrocycle Name')
            ->set('begin_date_for_editing', '01/01/2020')
            ->set('end_date_for_editing', '10/10/2020')
            ->set('team_id', 4)
            ->call('submitForm');

            $this->assertDatabaseHas('macrocycles', [
                'name' => 'Macrocycle Name',
                'begin_date' => '2020-01-01',
                'end_date' => '2020-10-10',
                'team_id' => 4
            ]);
    }

}
