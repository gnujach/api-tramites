<?php

namespace Tests\Feature;

use App\Departamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\User;

class DepartamentosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_authenticated_user_add_departamentos()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $departamento = factory(Departamento::class, 2)->create();
        $this->assertEquals(2, Departamento::count());
        $response = $this->get('/api/departamentos');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'departamentos',
                            'departamento_id' => $departamento->first()->id,
                            'attributes' => [
                                'nombre_departamento' => $departamento->first()->nombre_departamento,
                                'activo' => $departamento->first()->activo,
                                'created_at' => $departamento->first()->created_at->diffForHumans(),
                            ]
                        ],
                        'links' => [
                            'self' => url('/api/departamento/' . $departamento->first()->id),
                        ],
                    ],
                    [
                        'data' => [
                            'type' => 'departamentos',
                            'departamento_id' => $departamento->last()->id,
                            'attributes' => [
                                'nombre_departamento' => $departamento->last()->nombre_departamento,
                                'activo' => $departamento->last()->activo,
                                'created_at' => $departamento->last()->created_at->diffForHumans(),
                            ]
                        ],
                        'links' => [
                            'self' => url('/api/departamento/' . $departamento->last()->id),
                        ],
                    ],
                ],
                'links' => [
                    'self' => url('/api/departamentos/'),
                ]
            ]);
    }
}
