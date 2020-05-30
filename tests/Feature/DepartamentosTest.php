<?php

namespace Tests\Feature;

use App\Departamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
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
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
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
                                'updated_at' => $departamento->first()->updated_at->diffForHumans(),
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
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_authenticated_user_get_for_update_departamento()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'web');
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $departamento = factory(Departamento::class, 1)->create();
        $this->assertEquals(1, Departamento::count());
        $response = $this->get('/api/departamentos/' . $departamento[0]->id . '/edit');
        $response->assertStatus(200)
            ->assertJson([
                'data' =>
                [
                    'type' => 'departamentos',
                    'departamento_id' => $departamento->first()->id,
                    'attributes' => [
                        'nombre_departamento' => $departamento->first()->nombre_departamento,
                        'activo' => $departamento->first()->activo,
                        'created_at' => $departamento->first()->created_at->diffForHumans(),
                    ],
                ],
                'links' => [
                    'self' => url('/api/departamento/' . $departamento->first()->id),
                ],
            ]);
    }
    /**
     * A basic feature for update departamento.
     *
     * @test
     */
    public function can_authenticated_user_update_departamento()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'web');
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $departamento = factory(Departamento::class, 1)->create();
        $this->assertEquals(1, Departamento::count());
        $data =  [
            'nombre_departamento' => "Nombre de DEPARTAMENTO"
        ];
        $response = $this->put('/api/departamentos/' . $departamento[0]->id, $data);
        $response->assertStatus(200)
            ->assertJson([
                'data' =>
                [
                    'type' => 'departamentos',
                    'departamento_id' => $departamento->first()->id,
                    'attributes' => [
                        'nombre_departamento' => 'Nombre de DEPARTAMENTO',
                        'activo' => $departamento->first()->activo,
                        'created_at' => $departamento->first()->created_at->diffForHumans(),
                        'updated_at' => $departamento->first()->updated_at->diffForHumans(),
                    ],
                ],
                'links' => [
                    'self' => url('/api/departamento/' . $departamento->first()->id),
                ],
            ]);
    }
}
