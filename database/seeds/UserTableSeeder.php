<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'Connor Young',
        'email'    => 'connorkyoung@outlook.com',
        'password' => Hash::make('password'),
    ));
}

}
