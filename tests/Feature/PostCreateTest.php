<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class PostCreateTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_create_a_post()
    {
        $this->get('posts/create')
            ->assertRedirect('/admin/login');

        $this->post('posts', [])
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function users_cannot_create_a_post()
    {

        $this->userLogin();

        $this->get('posts/create')
            ->assertRedirect('/admin/login');

        $this->post('posts', [])
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function admin_can_show_post_form()
    {
        $this->adminLogin();

        $this->get(route('posts.create'))
            ->assertSee('Create');

    }

    /** @test */
    public function admin_can_create_a_post()
    {
        $this->adminLogin();

        $post = make('App\Post', [
            "content" => '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==">
            <p> Content </p>'
        ]);

        $this->post(route('posts.store'), $post->toArray());

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'description' => $post->description,
        ]);
    }

    /** @test */
    public function a_post_requires_a_title()
    {
        $this->publishPost(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_post_requires_a_description()
    {
        $this->publishPost(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_post_requires_a_content()
    {
        $this->publishPost(['content' => null])
            ->assertSessionHasErrors('content');
    }

    protected function publishPost($overrides = [])
    {
        $this->adminLogin();

        $post = make('App\Post', $overrides);

        return $this->post(route('posts.store'), $post->toArray());
    }

}
