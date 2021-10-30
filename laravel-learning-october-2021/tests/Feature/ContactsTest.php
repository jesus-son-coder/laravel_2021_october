<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $auth;

    /** Avant chaque exécution de Test,
     *  la méthode "setUp" sera exécutée !
     */
    protected function setUp():void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    protected function contactAttributes($overrides = []):array
    {
        $contactAttributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => '0102030405',
            'address' => $this->faker->sentence
        ];

        return array_merge($contactAttributes, $overrides);
    }

    /** @test */
    public function an_authenticated_user_can_create_contact()
    {
        $this->withoutExceptionHandling();

        // On crée un utilisateur $john :
        $john = $this->auth;

        // L'utilisateur $john se connecte
        $this->actingAs($john)
            // Il va lui-même faire une requête POST vers /contacts
            // pour créer un autre Contact/utilisateur
            // avec les informations envoyées :
            ->post('contacts', $this->contactAttributes())
            // Une Session de succès sera générée :
            ->assertSessionHas('success')
            // L'utilisateur $john sera redirigé vers Dashboard :
            ->assertRedirect('dashboard');

        // Un Contact va être créé,
        // et on peut le vérifier en Base de données dans la table "contacts" :
        $this->assertDatabaseHas('contacts', $this->contactAttributes());

    }

    /** @test */
    public function only_authenticated_user_can_create_a_contact()
    {
        /* Si l'utilisateur n'est pas authentifié
            et tente de créer un contact
            il est redirigé vers la page de Login : */
        $this->post('contacts', $this->contactAttributes())
            ->assertRedirect('/login');
    }

    /** @test */
    public function contact_creation_requires_a_name()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['name' => null]))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function contact_creation_requires_a_valid_email()
    {
        // email non fourni :
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['email' => null]))
            ->assertSessionHasErrors('email');

        // mauvais format d'email :
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['email' => 'bad-format-email']))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function contact_creation_requires_a_valid_phone()
    {
        // pas de téléphone saisi :
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => null]))
            ->assertSessionHasErrors('phone');

        // mauvais format de numéro de téléphone
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => 'adsjkljmljkljmh']))
            ->assertSessionHasErrors('phone');

        // nombre de caractères du numéro de téléphone pas correct
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => '010203']))
            ->assertSessionHasErrors('phone');

        // nombre de caractères du numéro de téléphone correct et bon format (numérique)
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => '0102030405']))
            ->assertSessionHas('success');
    }

    /** @test */
    public function contact_creation_requires_an_address()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['address' => null]))
            ->assertSessionHasErrors('address');
    }




}
