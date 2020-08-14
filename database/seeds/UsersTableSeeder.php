<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(50)->create();
        $user = User::find(1);
        $user->name = 'Shuimohun';
        $user->email = '8733517@qq.com';
        $user->is_admin = true;
        $user->save();
    }
}
