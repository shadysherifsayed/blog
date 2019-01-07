<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// All Tests Work Perfectly
class PostDeleteTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_delete_a_post()
    {
        $post = create('App\Post');

        $this->delete(route('posts.destroy', $post))
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function users_cannot_delete_a_post()
    {
        $this->userLogin();

        $post = create('App\Post');

        $this->delete(route('posts.destroy', $post))
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_delete_a_post()
    {

        $this->adminLogin();

        $post = create('App\Post');

        $this->delete(route('posts.destroy', $post));

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

}
