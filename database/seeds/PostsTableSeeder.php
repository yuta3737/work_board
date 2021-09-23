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
        // for ($i = 1; $i <= 20; $i++) {

        // DB::table('posts')->insert([
            
        //     'title' => 'タイトル'. $i,
        //     'user_id' => '1',
        // ]);   
        // }
        
        
        DB::table('posts')->insert([
            'title' => 'ヤクルトスワローズ',
            'user_id' => '1',
        ]); 
        
        DB::table('posts')->insert([
            'title' => '阪神タイガース',
            'user_id' => '1',
        ]);         

        DB::table('posts')->insert([
            'title' => '読売ジャイアンツ',
            'user_id' => '1',
        ]); 

        DB::table('posts')->insert([
            'title' => '中日ドラゴンズ',
            'user_id' => '1',
        ]); 
        
        
        DB::table('posts')->insert([
            'title' => '横浜DeNAベイスターズ',
            'user_id' => '1',
        ]);         
        
        
        DB::table('posts')->insert([
            'title' => '広島東洋カープ',
            'user_id' => '1',
        ]); 
        
        DB::table('posts')->insert([
            'title' => '福岡ソフトバンクホークス',
            'user_id' => '2',
        ]); 
        
        
        DB::table('posts')->insert([
            'title' => '千葉ロッテマリーンズ',
            'user_id' => '2',
        ]); 
        
        DB::table('posts')->insert([
            'title' => '埼玉西武ライオンズ',
            'user_id' => '2',
        ]);   
        
        DB::table('posts')->insert([
            'title' => '東北楽天ゴールデンイーグルス',
            'user_id' => '2',
        ]);   
        
        DB::table('posts')->insert([
            'title' => '北海道日本ハムファイターズ',
            'user_id' => '2',
        ]);   
        
        DB::table('posts')->insert([
            'title' => 'オリックス・バファローズ',
            'user_id' => '2',
        ]);           
    }
}
