<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class PostShowTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function all_types_of_users_can_show_a_post()
    {

        $post = create('App\Post', [
            'title' => 'Post title',
            'description' => 'Post description',
            'content' => 'Post content',
        ]);

        $this->get(route('posts.show', $post))
            ->assertSee('Post title')
            ->assertSee('Post description')
            ->assertSee('Post content');
    }

    /** @test */
    public function all_types_of_users_can_show_all_posts()
    {

        create('App\Post', [
            'title' => 'Post 1 title',
            'description' => 'Post 1 description',
        ]);

        create('App\Post', [
            'title' => 'Post 2 title',
            'description' => 'Post 2 description',
        ]);

        $this->get('/')
            ->assertSee('Post 1 title')
            ->assertSee('Post 2 title')
            ->assertSee('Post 1 description')
            ->assertSee('Post 2 description');

    }

    /** @test */
    public function posts_can_be_filtered_by_a_category()
    {

        $category = create('App\Category');

        $categoryPost1 = create('App\Post', [
            'title' => 'Post 1 that belongs to category title',
        ]);

        $categoryPost2 = create('App\Post', [
            'title' => 'Post 2 that belongs to category title',
        ]);

        $category->posts()->attach([$categoryPost1->id, $categoryPost2->id]);

        create('App\Post', [
            'title' => 'Post 1 that does not belong to category title',
        ]);

        create('App\Post', [
            'title' => 'Post 2 that does not belong to category title',
        ]);

        $this->get(route('categories.show', $category))
            ->assertSee('Post 1 that belongs to category title')
            ->assertSee('Post 2 that belongs to category title')
            ->assertDontSeeText('Post 1 that does not belong to category title')
            ->assertDontSeeText('Post 2 that does not belong to category title');

    }

}
