<?php

namespace Tests\Unit;

use App\View\Components\AppLayout;
use Illuminate\View\View;
use Tests\TestCase;

class AppLayoutTest extends TestCase
{
    public function testRenderMethodReturnsExpectedView()
    {
        // Arrange: Créer une instance de votre composant AppLayout
        $appLayout = new AppLayout;

        // Act: Appeler la méthode render
        $view = $appLayout->render();

        // Assert: Vérifier que la vue retournée est celle attendue
        $this->assertInstanceOf(View::class, $view); // Vérifie que c'est bien une vue
        $this->assertEquals('layouts.app', $view->name()); // Vérifie le nom de la vue
    }
}
