<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Team;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    public function a_team_can_add_members()
    {
        // Given

        $team = Team::factory()->create();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // when

        $team->add($user1);
        $team->add($user2);


        // Then

        $this->assertEquals(2, $team->count());

    }


    // /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = Team::factory()->create();

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

    }


    // /** @test */
    public function a_team_has_a_maximum_size()
    {

        // Given

        $team = Team::factory()->create(['size' => 3]);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // when

        $team->add($user1);
        $team->add($user2);


        // Then
        $this->assertEquals(2, $team->count());


        $user3 = User::factory()->create();
        $team->add($user3);

    }

    // /** @test */
    public function a_team_can_remove_a_member()
    {
        $team = Team::factory()->create(['size' => 2]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        // maintenant, je veux supprimer un User d une Team :
        $team->remove($users[0]);

        // assertion qui vérifie que la Size de la team a diminué :
        $this->assertEquals(1, $team->count());
    }


    // /** @test */
    public function a_team_can_remove_all_member_at_once()
    {
        $team = Team::factory()->create(['size' => 2]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $team->restart();

        $this->assertEquals(0, $team->count());
    }


    // /** @test */
    public function a_team_can_remove_more_than_one_member_at_once()
    {
        $team = Team::factory()->create(['size' => 3]);

        $users = User::factory()->count(3)->create();

        $team->add($users);

        $team->remove($users->slice(0,2));

        $this->assertEquals(1, $team->count());

    }

}


