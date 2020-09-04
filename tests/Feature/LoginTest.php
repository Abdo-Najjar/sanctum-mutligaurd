<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function admin_could_login_to_the_system()
    {

        factory(Admin::class)->create();

        $response = $this->postJson(route('admins.login'), [
            'email' => 'admin@admin.com',
            'password' => 'password',
            'device_name' => 'spa'
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'token'
            ]
        ]);
    }
}
