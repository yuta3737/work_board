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
        for ($i = 1; $i <= 20; $i++) {

        DB::table('posts')->insert([
            'title' => 'タイトル'. $i,
            'user_id' => '1',
        ]);   
        }
        
        for ($j = 21; $j <= 40; $j++) {

        DB::table('posts')->insert([
            'title' => 'タイトル'. $j,
            'user_id' => '2',
        ]);   
        }
        
    }
}
