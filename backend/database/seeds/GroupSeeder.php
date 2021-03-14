<?php

use Illuminate\Database\Seeder;

use App\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
            ['id' => 1, 'name' => 'administrator', 'description' => 'Administrator'],
            ['id' => 2, 'name' => 'supervisor', 'description' => 'Supervisor'],
            ['id' => 3, 'name' => 'user', 'description' => 'User'],
            ['id' => 4, 'name' => 'anthusias', 'description' => 'Anthusias']
        ]);
    }
}
