<?php
use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_player = new Role();
        $role_player->name = 'player';
        $role_player->description = 'A player user';
        $role_player->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An admin user';
        $role_admin->save();
    }
}
