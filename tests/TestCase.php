<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function userLogin($user = null)
    {
        $user = $user ? $user : create('App\User');

        $this->actingAs($user);

        return $this;
    }

    protected function adminLogin($admin = null)
    {
        $admin = $admin ? $admin : create('App\Admin');

        $this->actingAs($admin, 'admin');

        return $this;
    }

}
