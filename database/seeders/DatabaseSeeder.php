<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
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
        //apagar para nao dar erros caso des seed mais q uma vez sem aplicar migration
        // User::truncate();
        // Post::truncate();
        // Category::truncate();

        $user = User::factory()->create([
            'name' => 'Angelo Silva'
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);


        //$user = User::factory(1)->create();
        
        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // $coisas = Category::create([
        //     'name' => 'Coisas',
        //     'slug' => 'coisas'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'Primeiro',
        //     'slug' => 'primeiro',
        //     'excerpt' => 'sfasfsafasfasfasf fasfa',
        //     'body' => '<p>fhbahabhkfqbhkhbkfqbhkqwf
        //      qkf qkfwb qkbf qkwfb qkwjfb kjqf bkjbkljasbfk af 
        //      kabfkjbaskjfbaskbfwfçqwnfkbqnk fqkw bkqbf kqbf qkfb k</p>'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $coisas->id,
        //     'title' => 'Segundo',
        //     'slug' => 'segundo',
        //     'excerpt' => 'fsa fasfa',
        //     'body' => '<p>asgasggsgs qkf gas agssag qkwfb asg
        //      kjqf bkjbkljasbfk af kabfkjbaskjfbaskbfwfçqwnfkbqnk fqkw
        //       bkqbf kqbf qkfb k</p>'
        // ]);
    }
}
