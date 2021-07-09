<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 3; $i++) {

        DB::table('posts')->insert([
            'title' => 'タイトル'. $i,
            'user_id' => '1',
        ]);   
        }
        
        for ($j = 4; $j <= 6; $j++) {

        DB::table('posts')->insert([
            'title' => 'タイトル'. $j,
            'user_id' => '2',
        ]);   
        }
        
    }
}
