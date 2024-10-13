<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the language of the application.
     *
     * @param  string  $locale
     */
    public function changeLanguage($locale): RedirectResponse
    {
        // Vérifie si la langue est supportée
        if (in_array($locale, ['en', 'fr', 'es'])) { // Ajouter les autres langues ici
            Session::put('locale', $locale);
        }

        return redirect()->back(); // Redirige vers la page précédente
    }
}
