<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


// All Tests Work Perfectly
class AdminLoginTest extends TestCase
{
   
    use DatabaseMigrations;

    /** @test */
    public function admin_can_view_a_login_form()
    {
        $this->get('admin/login')
            ->assertSee('SIGN IN');
    }

    /** @test */
    public function admin_cannot_view_a_login_form_when_authenticated()
    {

        $this->adminLogin();

        $this->get('admin/login')
            ->assertRedirect('/');
    }

    /** @test */
    public function admin_can_logout()
    {

        $this->adminLogin();

        $this->post('admin/logout')
            ->assertRedirect('/');

    }

    /** @test */
    public function admin_cannot_login_if_username_is_wrong()
    {

        create('App\Admin', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post(route('admin.login'), [
            'username' => 'wrong',
            'password' => '123456',
        ]);

        $this->assertGuest('admin');
    }

    /** @test */
    public function admin_cannot_login_if_email_is_wrong()
    {

        create('App\Admin', [
            'email' => 'shady@user.com',
            'password' => bcrypt('123456'),
        ]);

        $this->post(route('admin.login'), [
            'username' => 'wrong@user.com',
            'password' => '123456',
        ]);

        $this->assertGuest('admin');

    }

    /** @test */
    public function admin_cannot_login_if_password_is_wrong()
    {

        create('App\Admin', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post(route('admin.login'), [
            'username' => 'shady',
            'password' => '1234567',
        ]);

        $this->assertGuest('admin');
    }

    /** @test */
    public function admin_can_login_using_username()
    {

        create('App\Admin', [
            'username' => 'shady',
            'password' => bcrypt('123456'),
        ]);

        $this->post(route('admin.login'), [
            'username' => 'shady',
            'password' => '123456',
        ]);

        $this->assertAuthenticated('admin');
    }

    /** @test */
    public function admin_can_login_using_email()
    {
        create('App\Admin', [
            'email' => 'shady@user.com',
            'password' => bcrypt('123456'),
        ]);

        $this->post(route('admin.login'), [
            'username' => 'shady@user.com',
            'password' => '123456',
        ]);

        $this->assertAuthenticated('admin');

    }
}
