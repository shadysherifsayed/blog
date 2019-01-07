<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class CategoryCreateTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_create_a_category()
    {
        $this->post('categories', [])
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function users_cannot_create_a_category()
    {

        $this->userLogin();

        $this->post('categories', [])
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_create_a_category()
    {

        $this->adminLogin();

        $category = make('App\Category')->toArray();

        $this->post(route('categories.store'), $category)
            ->assertJson([
                'category' => [
                    'id' => 1,
                    'name' => $category['name']
                ]
            ]);

        $this->assertDatabaseHas('categories', $category);
    }

    /** @test */
    public function a_category_requires_a_name()
    {
        $this->addCategory(['name' => null])
            ->assertSessionHasErrors('name');

    }

    protected function addCategory($overrides = [])
    {
        $this->adminLogin();

        $category = make('App\Category', $overrides);

        return $this->post(route('categories.store'), $category->toArray());
    }
}
