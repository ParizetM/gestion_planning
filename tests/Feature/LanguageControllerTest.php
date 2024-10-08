<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase; // Si tu utilises une base de données pour tes tests

    /**
     * Test the changeLanguage method with valid locale.
     *
     * @return void
     */
    public function test_it_changes_language_successfully()
    {
        // Simuler un appel à la méthode avec une langue valide
        $response = $this->get('/change-language/en');

        // Vérifie si la langue est bien changée en session
        $this->assertEquals('en', Session::get('locale'));

        // Vérifie la redirection vers la page précédente
        $response->assertStatus(302); // Code HTTP de redirection
        $response->assertRedirect(); // Vérifie que c'est bien une redirection
    }

    /**
     * Test the changeLanguage method with invalid locale.
     *
     * @return void
     */
    public function test_it_does_not_change_language_for_invalid_locale()
    {
        // Simuler un appel avec une langue non supportée
        $response = $this->get('/change-language/invalid-lang');

        // Vérifie que la langue n'a pas été changée
        $this->assertNull(Session::get('locale'));

        // Vérifie la redirection vers la page précédente
        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
