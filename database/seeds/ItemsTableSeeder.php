<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 1000; $i++) {
            App\Item::create([
                'title' => 'Title '.$i,
                'description' => 'Description '.$i,
                'image' => '1568996582.jpeg',
                'user_id' => 11
            ]);
        }
    }
}
