<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Models\Moto;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_access_admin_routes()
    {
        $client = User::factory()->create(['role' => 'client']);

        // Try to access create page
        $response = $this->actingAs($client)->get(route('motos.create'));
        $response->assertStatus(403);

        // Try to access brands management
        $response = $this->actingAs($client)->get(route('marcas.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('motos.create'));
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get(route('marcas.index'));
        $response->assertStatus(200);
    }

    public function test_client_does_not_see_admin_buttons()
    {
        $client = User::factory()->create(['role' => 'client']);
        
        // Setup data for index view
        $marca = new Marca(); $marca->nombre = 'B'; $marca->save();
        $modelo = new Modelo(); $modelo->nombre = 'M'; $modelo->idmarca = $marca->id; $modelo->save();
        $tipo = new Tipo(); $tipo->nombre = 'T'; $tipo->save();
        Moto::create([
            'idmodelo' => $modelo->id, 'year' => 2020, 'cilindrada' => '100', 
            'idtipo' => $tipo->id, 'descripcion' => 'D', 'precio' => 100
        ]);

        $response = $this->actingAs($client)->get(route('motos.index'));
        $response->assertDontSee('Añadir Nueva Moto');
        $response->assertDontSee('Gestionar Motos');
    }

    public function test_admin_sees_admin_buttons()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Setup data for index view
        $marca = new Marca(); $marca->nombre = 'B'; $marca->save();
        $modelo = new Modelo(); $modelo->nombre = 'M'; $modelo->idmarca = $marca->id; $modelo->save();
        $tipo = new Tipo(); $tipo->nombre = 'T'; $tipo->save();
        Moto::create([
            'idmodelo' => $modelo->id, 'year' => 2020, 'cilindrada' => '100', 
            'idtipo' => $tipo->id, 'descripcion' => 'D', 'precio' => 100
        ]);

        $response = $this->actingAs($admin)->get(route('motos.index'));
        $response->assertSee('Añadir Nueva Moto');
        $response->assertSee('Gestionar Motos');
    }
}
