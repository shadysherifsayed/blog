<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories Seeder
        factory(App\Category::class, 10)->create();

        // Posts Seeder
        factory(App\Post::class, 50)->create()->each(function($post) {
            $post->categories()->attach(App\Category::inRandomOrder()->limit(random_int(1, 5))->get());
        });

        // Users Seeder
        App\User::create([
            'name' => 'Shady Sherif',
            'username' => 'shady',
            'email' => 'shady@user.com',
            'password' => bcrypt('123456'),
        ]);

        // Admin Seeder
        App\Admin::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('123456'),
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
