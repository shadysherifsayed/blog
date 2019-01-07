<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// All Tests Work Perfectly
class CategoryAttachToPostTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function category_can_be_attached_to_a_post()
    {
        $category = create('App\Category');

        $post = create('App\Post');

        $post->categories()->attach($category);

        $this->assertTrue($category->isPostAttached($post));
    }

    /** @test */
    public function category_can_be_detached_from_a_post()
    {
        $category = create('App\Category');

        $post = create('App\Post');

        $post->categories()->attach($category);

        $this->assertTrue($category->isPostAttached($post));

        $post->categories()->detach($category);

        $this->assertFalse($category->isPostAttached($post));
    }

}
