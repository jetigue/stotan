<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class TeamScopeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @tcd ..
     * est
     */
    public function a_model_has_a_team_id_on_a_migration()
    {
        $this->artisan('make:model Test -m');

        $files = File::glob(database_path() . '\migrations\*create_tests_table.php');
        count($files) > 0 ? $filename = $files[0] : $filename = null;

        $this->assertTrue(File::exists($filename));
        $this->assertStringContainsString('$table->unsignedBigInteger(\'team_id\')->index();',
            File::get($filename));

        File::delete($filename);
        File::delete(app_path('/Models/Test.php'));
    }

    /** @test */
    public function a_user_can_only_see_users_on_the_same_team()
    {
        $team1 = Team::factory()->create();
        $team2 = Team::factory()->create();

        $user1 = User::factory()->create([
            'team_id' => $team1
        ]);

        User::factory()->count(9)->create(['team_id' => $team1]);
        User::factory()->count(10)->create(['team_id' => $team2]);

        auth()->login($user1);

        $this->assertEquals(10, User::count());
    }

    /** @test */
    public function test_a_user_can_only_create_a_user_in_his_team()
    {
        $team1 = Team::factory()->create();
        $team2 = Team::factory()->create();

        $user1 = User::factory()->create([
            'team_id' => $team1,
        ]);

        auth()->login($user1);

        $createdUser = User::factory()->create();

        $this->assertTrue($createdUser->team_id == $user1->team_id);
    }

        /** @test */
    public function test_a_user_can_only_create_a_user_in_his_team_even_if_other_team_is_provided()
    {
        $team1 = Team::factory()->create();
        $team2 = Team::factory()->create();

        $user1 = User::factory()->create([
            'team_id' => $team1,
        ]);

        auth()->login($user1);

        $createdUser = User::factory()->make();
        $createdUser->team_id = $team2->id;
        $createdUser->save();

        $this->assertTrue($createdUser->team_id == $user1->team_id);
    }
}
