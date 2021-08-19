<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // for ($i = 1; $i <= 3; $i++) {

        // DB::table('comments')->insert([
        //     'body' => 'this is body'. $i,
        //     'user_id' => '1',
        //     'post_id' => '1',
        // ]);   
        // }
        
        // for ($j = 4; $j <= 6; $j++) {

        // DB::table('comments')->insert([
        //     'body' => 'this is body'. $j,
        //     'user_id' => '2',
        //     'post_id' => '2',
        // ]);   
        // }
        
        factory(App\Comment::class, 30)->create();
        
    }
}
