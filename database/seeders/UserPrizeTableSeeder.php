<?php

namespace Database\Seeders;

use App\Models\UserPrize;
use Illuminate\Database\Seeder;

class UserPrizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserPrize::factory(1000)->create();
    }
}
