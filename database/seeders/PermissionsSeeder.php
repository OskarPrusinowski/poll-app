<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $permissions = ['usersShow', 'usersManage', 'companiesShow', 'companiesManage', 'campaignsShow', 'campaignsManage', 'contactsShow', 'contactsManage', 'settingsShow', 'settingsManage'];

    public function run()
    {
        $data = [];
        foreach ($this->permissions as $permission) {
            $data[] = ['name' => $permission];
        }
        DB::table('permissions')->insert($data);
    }
}
