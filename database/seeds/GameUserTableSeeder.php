<?php

use Illuminate\Database\Seeder;

class GameUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GameUser::class, 20)->create();
    }
}
