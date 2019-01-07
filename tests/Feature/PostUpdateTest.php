<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class PostUpdateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_update_a_post()
    {

        $post = create('App\Post');

        $this->get(route('posts.edit', $post))
            ->assertRedirect('/admin/login');

        $this->put(route('posts.update', $post))
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function users_cannot_update_a_post()
    {

        $this->userLogin();

        $post = create('App\Post');

        $this->get(route('posts.edit', $post))
            ->assertRedirect('/admin/login');

        $this->put(route('posts.update', $post))
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_show_update_post_form()
    {
        $admin = create('App\Admin');

        $this->adminLogin($admin);

        $post = create('App\Post');

        $this->get(route('posts.edit', $post))
            ->assertSee('Edit');
    }

    /** @test */
    public function admin_can_update_a_post()
    {

        $this->adminLogin();

        $post = create('App\Post', [
            'title' => 'Old Post',
        ]);

        $newTitle = 'You have been changed';

        // We have to provide all required fields to pass the validation rules
        $this->put(route('posts.update', $post), [
            'title' => $newTitle,
            'content' => $post->content,
            'description' => $post->description,
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $newTitle,
        ]);

    }

    /** @test */

}
