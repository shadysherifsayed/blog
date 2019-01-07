<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// All Tests Work Perfectly
class AdminRegistrationTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function admin_can_view_a_registration_form()
    {
        $this->get('admin/register')
            ->assertSee('REGISTER');
    }

    /** @test */
    public function admin_cannot_view_a_registration_form_when_authenticated()
    {

        $this->adminLogin();

        $this->get('admin/register')
            ->assertRedirect('/');
    }

    /** @test */
    public function admin_can_register()
    {
        $admin = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@admin.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'avatar' => UploadedFile::fake()->image('shady.jpg')
        ];

        $this->post('admin/register', $admin);

        $this->assertDatabaseHas('admins', [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@admin.com',
        ]);

        $this->assertAuthenticated('admin');
    }

    /** @test */
    public function registration_requires_a_name()
    {
        $admin = [
            'username' => 'shady',
            'email' => 'shady@admin.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('admin/register', $admin)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function email_must_be_unique()
    {

        create('App\Admin', [
            'email' => 'shady@admin.com',
        ]);

        $admin = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@admin.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('admin/register', $admin)
            ->assertSessionHasErrors('email');

    }

    /** @test */
    public function username_must_be_unique()
    {

        create('App\Admin', [
            'username' => 'shady',
        ]);

        $admin = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@admin.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('admin/register', $admin)
            ->assertSessionHasErrors('username');

    }

    /** @test */
    public function password_must_be_confirmed()
    {

        $admin = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@admin.com',
            'password' => '123456',
            'password_confirmation' => '1234567',
        ];

        $this->post('admin/register', $admin)
            ->assertSessionHasErrors('password');

    }

}
