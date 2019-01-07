<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// All Tests Work Perfectly
class AvatarTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function return_default_avatar_it_no_one_was_provides() {

        $defaultAvatar = 'images/defaults/avatar.png';

        $admin = create('App\Admin', [
            'avatar' => null
        ]);

        $this->assertEquals($admin->avatar, asset($defaultAvatar));

        $user = create('App\User', [
            'avatar' => null
        ]);

        $this->assertEquals($user->avatar, asset($defaultAvatar));
    }


    /** @test */
    public function return_avatar_it_one_was_provides() {

        $avatar = 'images/avatar/shadysherif.jpg';

        $admin = create('App\Admin', [
            'avatar' => $avatar
        ]);

        $this->assertEquals($admin->avatar, asset("storage/$avatar"));

        $user = create('App\User', [
            'avatar' => $avatar
        ]);

        $this->assertEquals($user->avatar, asset("storage/$avatar"));

    }
}
