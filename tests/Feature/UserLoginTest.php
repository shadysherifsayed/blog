<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class UserLoginTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function user_can_view_a_login_form()
    {
        $this->get('login')
            ->assertSee('SIGN IN');
    }

    /** @test */
    public function user_cannot_view_a_login_form_when_authenticated()
    {

        $this->userLogin();

        $this->get('login')
            ->assertRedirect('/');
    }

    /** @test */
    public function user_can_logout()
    {

        $this->userLogin();

        $this->post('logout')
            ->assertRedirect('/');
    }


    /** @test */
    public function user_cannot_login_if_username_is_wrong()
    {

        create('App\User', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post('login', [
            'username' => 'wrong',
            'password' => '123456',
        ])->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_if_email_is_wrong()
    {

        create('App\User', $credentials = [
            'email' => 'shady@user.com',
            'password' => bcrypt('123456'),
        ]);

        $this->post('login', [
            'username' => 'wrong@user.com',
            'password' => '123456',
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_if_password_is_wrong()
    {

        create('App\User', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post('login', [
            'username' => 'shady',
            'password' => '1234567',
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function password_cannot_be_empty()
    {

        $this->post('login', [
            'username' => 'shady',
        ])
            ->assertSessionHasErrors('password');

        $this->assertGuest();
    }

    /** @test */
    public function user_can_login_using_username()
    {

        create('App\User', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post('login', [
            'username' => 'shady',
            'password' => '123456',
        ]);

        $this->assertAuthenticated();

    }

    /** @test */
    public function user_can_login_using_email()
    {
        create('App\User', [
            'email' => 'shady@user.com',
            'password' => bcrypt('123456'),
        ]);

        $this->post('login', [
            'username' => 'shady@user.com',
            'password' => '123456',
        ]);

        $this->assertAuthenticated();
    }


}
