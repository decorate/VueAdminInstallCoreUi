<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->truncate();

        $pass = Hash::make('secret');

        factory(Admin::class, 1)
            ->create([
                'name' => 'admin',
                'password' => $pass
            ]);

        factory(Admin::class, 1)
            ->create([
                'name' => 'developer',
                'password' => $pass
            ]);
    }
}
