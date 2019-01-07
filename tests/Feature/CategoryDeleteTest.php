<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class CategoryDeleteTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_delete_a_category()
    {
        $category = create('App\Category');

        $this->delete(route('posts.destroy', $category))
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function users_cannot_delete_a_category()
    {
        $this->userLogin();

        $category = create('App\Category');

        $this->delete(route('categories.destroy', $category))
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_delete_a_category()
    {

        $this->adminLogin();

        $category = create('App\Category');

        $this->delete(route('categories.destroy', $category));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

}
