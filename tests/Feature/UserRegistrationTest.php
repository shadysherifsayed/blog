<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// All Tests Work Perfectly
class UserRegistrationTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_can_register()
    {
        $user = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'avatar' => UploadedFile::fake()->image('shady.jpg')
        ];

        $this->post('register', $user);

        $this->assertDatabaseHas('users', [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@user.com',
        ]);

        $this->assertAuthenticated();
    }

    /** @test */
    public function registration_requires_a_name()
    {
        $user = [
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('register', $user)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function email_must_be_unique()
    {

        create('App\User', [
            'email' => 'shady@user.com'
        ]);

        $user = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('register', $user)
            ->assertSessionHasErrors('email');

    }

    /** @test */
    public function username_must_be_unique()
    {

        create('App\User', [
            'username' => 'shady',
        ]);

        $user = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->post('register', $user)
            ->assertSessionHasErrors('username');

    }

    /** @test */
    public function password_must_be_confirmed()
    {

        $user = [
            'name' => 'Shady',
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => '123456',
            'password_confirmation' => '1234567',
        ];

        $this->post('register', $user)
            ->assertSessionHasErrors('password');

    }

    /** @test */
    public function user_can_view_a_registration_form()
    {
        $this->get('register')
            ->assertSee('REGISTER');
    }

    /** @test */
    public function user_cannot_view_a_registration_form_when_authenticated()
    {

        $this->userLogin();

        $this->get('register')
            ->assertRedirect('/');
    }
}
