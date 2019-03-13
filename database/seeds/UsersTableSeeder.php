<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 10)->create();
        $role_player = Role::where('name', 'player')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $admin = new User();
        $admin->full_name = 'Youssef Admin';
        $admin->user_name = 'Youssef';
        $admin->email = 'youssef@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $player1 = new User();
        $player1->full_name = 'Salah Player';
        $player1->user_name = 'Salih';
        $player1->email = 'salah@gmail.com';
        $player1->password = bcrypt('secret');
        $player1->save();
        $player1->roles()->attach($role_player);

        $player2 = new User();
        $player2->full_name = 'Ali Player';
        $player2->user_name = 'Ali';
        $player2->email = 'ali@gmail.com';
        $player2->password = bcrypt('secret');
        $player2->save();
        $player2->roles()->attach($role_player);

        $player3 = new User();
        $player3->full_name = 'Yassine Player';
        $player3->user_name = 'Yassine';
        $player3->email = 'yassine@gmail.com';
        $player3->password = bcrypt('secret');
        $player3->save();
        $player3->roles()->attach($role_player);

        $player4 = new User();
        $player4->full_name = 'Mahmoud Player';
        $player4->user_name = 'Mahmoud';
        $player4->email = 'mahmoud@gmail.com';
        $player4->password = bcrypt('secret');
        $player4->save();
        $player4->roles()->attach($role_player);
    }
}
