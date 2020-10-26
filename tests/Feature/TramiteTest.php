<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Tramite;

use Spatie\Permission\Models\Role;
use \App\User;

class TramiteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_autheticated_user_list_tramites()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $tramites = factory(Tramite::class, 2)->create();
        $response = $this->get('/api/tramites');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'tramites',
                            'tramite_id' => $tramites->first()->id,
                            'attributes' => [
                                'nombre' => $tramites->first()->nombre,
                                'departamento_id' => $tramites->first()->departamento_id,
                                'tipousuario_id' => $tramites->first()->tipousuario_id,
                                'dependencia_id' => $tramites->first()->dependencia_id,
                                'objetivo'  => $tramites->first()->objetivo,
                                'documento_obtenido' => $tramites->first()->documento_obtenido,
                                'datos_institucionales' => $tramites->first()->datos_institucionales,
                                'plazo_respuesta' => $tramites->first()->plazo_respuesta,
                                'costo' => $tramites->first()->costo,
                                'url_proceso'   => $tramites->first()->url_proceso,
                                'activo' => $tramites->first()->activo,
                                'created_at' => $tramites->first()->created_at->diffForHumans(),
                                'updated_at' => $tramites->first()->updated_at->diffForHumans(),
                            ]
                        ],
                        'links' => [
                            'self' => url('/api/tramites/' . $tramites->first()->id),
                        ],
                    ],
                    [
                        'data' => [
                            'type' => 'tramites',
                            'tramite_id' => $tramites->last()->id,
                            'attributes' => [
                                'nombre' => $tramites->last()->nombre,
                                'departamento_id' => $tramites->last()->departamento_id,
                                'tipousuario_id' => $tramites->last()->tipousuario_id,
                                'dependencia_id' => $tramites->last()->dependencia_id,
                                'objetivo'  => $tramites->last()->objetivo,
                                'documento_obtenido' => $tramites->last()->documento_obtenido,
                                'datos_institucionales' => $tramites->last()->datos_institucionales,
                                'plazo_respuesta' => $tramites->last()->plazo_respuesta,
                                'costo' => $tramites->last()->costo,
                                'url_proceso'   => $tramites->last()->url_proceso,
                                'activo' => $tramites->last()->activo,
                                'created_at' => $tramites->last()->created_at->diffForHumans(),
                                'updated_at' => $tramites->last()->updated_at->diffForHumans(),
                            ]
                        ],
                        'links' => [
                            'self' => url('/api/tramites/' . $tramites->last()->id),
                        ],
                    ],
                ],
                'links' => [
                    'self' => url('/api/tramites/'),
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_authenticated_user_add_tramite_from_data()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $dependencia = factory(\App\Dependencia::class, 1)->create();
        $departamento = factory(\App\Departamento::class, 1)->create();
        $tipousuario = factory(\App\Tipousuario::class, 1)->create();
        // dd($tipousuario[0]->id);
        $data = [
            'nombre' => 'Cambio de contraseña',
            'dependencia_id' => $dependencia[0]->id,
            'tipousuario_id' => $tipousuario[0]->id,
            'departamento_id' => $departamento[0]->id,
            'objetivo' => 'permitir cambio de contraseña correo electrónico',
            'documento_obtenido' => 'Nueva contraseña',
            'datos_institucionales' => 'Artículo 3 sección 2',
            'plazo_respuesta' => 'un día',
            'costo' => 0,
            'url_proceso' => 'https://usae.netlifly.app',
            'activo' => true
        ];
        $response = $this->post('/api/tramites/', $data);
        // dd($response['data']['attributes']['nombre']);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'tramites',
                    'tramite_id' => $response['data']['tramite_id'],
                    'attributes' => [
                        'nombre' => $response['data']['attributes']['nombre'],
                        'departamento_id' => $response['data']['attributes']['departamento_id'],
                        'tipousuario_id' => $response['data']['attributes']['tipousuario_id'],
                        'dependencia_id' => $response['data']['attributes']['dependencia_id'],
                        'objetivo'  => $response['data']['attributes']['objetivo'],
                        'documento_obtenido' => $response['data']['attributes']['documento_obtenido'],
                        'datos_institucionales' => $response['data']['attributes']['datos_institucionales'],
                        'plazo_respuesta' => $response['data']['attributes']['plazo_respuesta'],
                        'costo' => $response['data']['attributes']['costo'],
                        'url_proceso'   => $response['data']['attributes']['url_proceso'],
                        'activo' => $response['data']['attributes']['activo'],
                        'created_at' => $response['data']['attributes']['created_at'],
                        'updated_at' => $response['data']['attributes']['updated_at'],
                    ]
                ],
                'links' => [
                    'self' => url('/api/tramites/' . $response['data']['tramite_id']),
                ],
            ]);
    }
}
