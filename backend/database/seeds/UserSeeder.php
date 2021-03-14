<?php

use Illuminate\Database\Seeder;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['id' => 1, 'name' => 'Administrator', 'email' => 'administrator@depokbersih.org', 'phone_number' => '080808080808', 'address' => 'Deket', 'password' => bcrypt('password'), 'status' => 1, 'token' => Str::random(64), 'qrcode' => Uuid::uuid4(), 'email_verified_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Supervisor', 'email' => 'supervisor@depokbersih.org', 'phone_number' => '080808080808', 'address' => 'Deket', 'password' => bcrypt('password'), 'status' => 1, 'token' => Str::random(64), 'qrcode' => Uuid::uuid4(), 'email_verified_at' => Carbon::now()],
            ['id' => 3, 'name' => 'User', 'email' => 'bambang@depokbersih.org', 'phone_number' => '080808080808', 'address' => 'Deket', 'password' => bcrypt('password'), 'status' => 1, 'token' => Str::random(64), 'qrcode' => Uuid::uuid4(), 'email_verified_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Anthusias', 'email' => 'ferguso@depokbersih.org', 'phone_number' => '080808080808', 'address' => 'Deket', 'password' => bcrypt('password'), 'status' => 1, 'token' => Str::random(64), 'qrcode' => Uuid::uuid4(), 'email_verified_at' => Carbon::now()],
        ]);

        User::find(1)->groups()->sync(1);
        User::find(2)->groups()->sync(2);
        User::find(3)->groups()->sync(3);
        User::find(4)->groups()->sync(4);
    }
}
