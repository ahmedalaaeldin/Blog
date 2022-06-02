<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       //user
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //     \App\Models\User::factory()->create([
        //             'name' => 'Test User',
        //             'email' => 'test@example.com',
        //             'password' => Hash::make('123456')
        //      ]);
        //         //post
        //      \App\Models\posts::create([
        //                 'name' => 'test data to post 1',
        //                 'details' => 'test data to post 1',
        //                  'user_id' => '1'
        //          ]);
                
        //          \App\Models\posts::create([
        //             'name' => 'test data to post 2',
        //             'details' => 'test data to post 2',
        //             'user_id' => '1'
        //      ]);
        //      \App\Models\posts::create([
        //         'name' => 'test data to post 3',
        //         'details' => 'test data to post 3',
        //         'user_id' => '1'
        //  ]);
         \App\Models\posts::create([
            'name' => 'test data to post 5',
            'details' => 'test data to post 5',
            'user_id' => '2'
     ]);
     \App\Models\posts::create([
        'name' => 'test data to post 6',
        'details' => 'test data to post 6',
        'user_id' => '2'
 ]);
         //post comments
        //  \App\Models\PostsComments::create([
        //             'user_id' => '1',
        //             'post_id' => '1',
        //             'comment' => 'commment 1'
        //      ]);
            
        //      \App\Models\PostsComments::create([
        //         'user_id' => '1',
        //         'post_id' => '1',
        //         'comment' => 'commment 3'
        //  ]);
      
        // php artisan migrate:reset     # rollback all migrations
        // php artisan migrate           # run migrations
        // php artisan db:seed           # run seeders

    }
}
