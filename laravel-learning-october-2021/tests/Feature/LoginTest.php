<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function when_a_user_gives_his_credentials_he_is_authenticated()
    {
        $this->withoutExceptionHandling();

        // Un Utilisateur doit exister dans la DB
        $john = User::factory()->create();

        // Un Utilisateur fournit ses infos (email + mot de passe)
        $credentials = [
            'email' => 'john@email',
            'password' => 'password'
        ];

        // Il soumet une requpête POST vers /login
        $this->post('/login', $credentials)
            // et est redirigé vers le Dashboard :
            ->assertRedirect(route('dashboard'));

            // Il est authentifié
            $this->assertEquals(auth()->id(), $john->id);
    }

    /** @test */
    public function to_be_authenticated_a_user_must_give_an_existing_email()
    {
        $this->post('/login', [
            'email' => 'fake@email.com',
            'password' => 'Hello-world'
        ])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function to_be_authenticated_a_user_must_give_a_valid_email()
    {
        $this->post('/login', [
            'email' => 'fake',
            'password' => 'Hello-world'
        ])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function authentication_required_email()
    {
        $this->post('/login', [
            'email' => '',
            'password' => 'Hello-world'
        ])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function authentication_required_password()
    {
        $this->post('/login', [
            'email' => '',
            'password' => ''
        ])
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function to_be_authenticated_a_user_should_give_the_exact_password()
    {
        // $this->withoutExceptionHandling();

        $john = User::factory()->create();

        $credentials = [
            'email' => $john->email,
            'password' => 'mauvais-password'
        ];

        $this->post('/login', $credentials)
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function only_unauthenticated_can_access_to_the_login_page()
    {
        $this->actingAs(User::factory()->create())
            ->get('/login')
            ->assertRedirect('/dashboard');

    }

}


