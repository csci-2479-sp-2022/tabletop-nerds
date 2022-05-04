<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userFactory = User::factory();
        $userFactory->count(5)->create();
        $userFactory->create(['email' => 'admin@admin.com', 'is_admin' => true]);
    }
}
