<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// All Tests Work Perfectly
class CategoryUpdateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_update_a_category()
    {

        $category = create('App\Category');

        $this->put(route('categories.update', $category), [])
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function users_cannot_update_a_category()
    {

        $this->userLogin();

        $category = create('App\Category');

        $this->put(route('categories.update', $category), [])
            ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_update_a_category()
    {

        $this->adminLogin();

        $category = create('App\Category', [
            'name' => 'Old Category',
        ]);

        $newName = 'You have been changed';

        $this->put(route('categories.update', $category), [
            'name' => $newName,
        ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $newName,
        ]);

    }

   
}
