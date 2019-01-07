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
    public function post_categories_can_be_updated()
    {

        $this->adminLogin();

        $post = create('App\Post');

        create('App\Category', [], 4);

        $post->categories()->attach([1, 2]);

        // We have to provide all required fields to pass the validation rules
        $this->put(route('posts.update', $post), [
            'title' => $post->title,
            'description' => $post->description,
            'content' => $post->content,
            'categories' => [2, 4],
        ]);

        $postCategoriesIds = $post->categories()->select('categories.id')->get()->pluck('id');

        $this->assertEquals($postCategoriesIds, collect([2, 4]));
        
        $this->assertFalse($postCategoriesIds->contains(1));

    }
}
