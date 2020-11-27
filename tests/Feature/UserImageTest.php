<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use \App\User;
use \App\UserImage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UserImageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }


    /**
     * A basic feature image uploaded
     * @test
     */
    public function image_can_be_uploaded()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $file = UploadedFile::fake()->image('user-image.jpg');
        $response = $this->post('/api/user-images', [
            'image' => $file,
            'width' => 850,
            'height' => 300,
            'location' => 'cover'
        ])->assertStatus(201);

        Storage::disk('public')->assertExists('user-images/' . $file->hashName());
        $userImage = UserImage::first();
        // $this->assertEquals('user-images/' . $file->hashName(), $userImage->path);
        $this->assertEquals('850', $userImage->width);
        $this->assertEquals('300', $userImage->height);
        $this->assertEquals('cover', $userImage->location);
        $this->assertEquals($user->id, $userImage->user_id);
        $response->assertJson([
            'data' => [
                'type' => 'user-image',
                'user-image_id' => $userImage->id,
                'attributes' => [
                    'path' => url($userImage->path),
                    'width' => $userImage->width,
                    'height' => $userImage->height,
                    'location' => $userImage->location,
                ]
            ],
            'links' => [
                'self' => url('/users/' . $user->id)
            ]
        ]);
    }

    /**
     * a use are returned with their images
     * @test
     */
    public function users_are_returned_with_their_images()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $file = UploadedFile::fake()->image('user-image.jpg');
        $this->post('/api/user-images', [
            'image' => $file,
            'width' => 850,
            'height' => 300,
            'location' => 'cover'
        ])->assertStatus(201);
        $this->post('/api/user-images', [
            'image' => $file,
            'width' => 850,
            'height' => 300,
            'location' => 'profile'
        ])->assertStatus(201);
        $response = $this->get('/api/users/' . $user->id)
            ->assertStatus(200);
        // $userImage = UserImage::first();
        $response->assertJson([
            'data' => [
                'type' => 'users',
                'user_id' => $user->id,
                'attributes' => [
                    'name' => $user->name,
                    'cover_image' => [
                        'data' => [
                            'type' => 'user-image',
                            'user-image_id' => 1,
                            'attributes' => []
                        ],
                    ],
                    'profile_image' => [
                        'data' => [
                            'type' => 'user-image',
                            'user-image_id' => 2,
                            'attributes' => []
                        ],
                    ],

                ],
            ],
            'links' => [
                'self' => url('/api/users/' . $user->id)
            ]
        ]);
    }
    /**
     * a use are returned with their images
     * @test
     */
    public function users_are_returned_with_their_image_profile()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create());
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $file = UploadedFile::fake()->image('user-image.jpg');
        $this->post('/api/user-images', [
            'image' => $file,
            'width' => 850,
            'height' => 300,
            'location' => 'profile'
        ])->assertStatus(201);
        $response = $this->get('/api/users/' . $user->id)
            ->assertStatus(200);
        $userImage = UserImage::first();
        $response->assertJson([
            'data' => [
                'type' => 'users',
                'user_id' => $user->id,
                'attributes' => [
                    'name' => $user->name,
                    'profile_image' => [
                        'data' => [
                            'type' => 'user-image',
                            'user-image_id' => $userImage->id,
                            'attributes' => []
                        ],
                    ],
                ],
            ],
            'links' => [
                'self' => url('/api/users/' . $user->id)
            ]
        ]);
    }
}
