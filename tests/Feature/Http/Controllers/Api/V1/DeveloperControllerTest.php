<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Developer;

class DeveloperControllerTest extends TestCase
{
    use RefreshDAtabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $this->withoutExceptionHandling();
        $response = $this->json('POST', '/api/developers', [
            'name' => 'José María Lanza',
            'profession' => 'Desarrollador',
            'position' => 'Backend',
            'technology' => 'Laravel'
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'slug',
            'profession',
            'position',
            'technology',
            'created_at',
            'updated_at'
        ])
            ->assertJson([
                'name' => 'José María Lanza',
                'profession' => 'Desarrollador',
                'position' => 'Backend',
                'technology' => 'Laravel'
            ])
            ->assertStatus(201); // Ok, creado el recurso

        $this->assertDatabaseHas('developers', [
            'name' => 'José María Lanza',
            'profession' => 'Desarrollador',
            'position' => 'Backend',
            'technology' => 'Laravel'
        ]);
    }

    public function test_validate_name()
    {
        // Intentando salvar un programador sin nombre
        $response = $this->json('POST', '/api/developers', [
            'name' => '',
            'profession' => 'Desarrollador',
            'position' => 'Backend',
            'technology' => 'Laravel'
        ]);

        // Solicitud correcta pero imposible de completar
        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_show()
    {
        $developer = Developer::factory()->create();

        $response = $this->json('GET', "/api/developers/$developer->id");

        $response->assertJsonStructure([
            'id',
            'name',
            'slug',
            'profession',
            'position',
            'technology',
            'created_at',
            'updated_at'
        ])
            ->assertJson([
                'name' => $developer->name,
                'slug' => $developer->slug,
                'profession' => $developer->profession,
                'position' => $developer->position,
                'technology' => $developer->technology
            ])
            ->assertStatus(200);
    }

    public function test_404_show()
    {
        $response = $this->json('GET', '/api/developers/1000');

        $response->assertStatus(404);
    }

    public function test_update()
    {
        $developer = Developer::factory()->create();

        $response = $this->json('PUT', "/api/developers/$developer->id", [
            'name' => 'José Lanza',
            'profession' => 'Desarrollador',
            'position' => 'Frontend',
            'technology' => 'Laravel'
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'slug',
            'profession',
            'position',
            'technology',
            'created_at',
            'updated_at'
        ])
            ->assertJson([
                'name' => 'José Lanza',
                'profession' => 'Desarrollador',
                'position' => 'Frontend',
                'technology' => 'Laravel'
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas('developers', [
            'name' => 'José Lanza',
            'profession' => 'Desarrollador',
            'position' => 'Frontend',
            'technology' => 'Laravel'
        ]);
    }

    public function test_delete()
    {
        $developer = Developer::factory()->create();

        $response = $this->json('DELETE', "/api/developers/$developer->id");

        $response->assertSee(null)
            ->assertStatus(204); // No hay contenido

        $this->assertDatabaseMissing('developers', [
            'id' => $developer->id
        ]);
    }

    public function test_index()
    {
        Developer::factory(5)->create();

        $response = $this->json('GET', '/api/developers');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'slug',
                    'profession',
                    'position',
                    'technology',
                    'created_at',
                    'updated_at'
                ]
            ]
        ])
        ->assertStatus(200);
    }
}
