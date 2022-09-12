<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$user = User::create([
'name' => 'ashrakt',
'email' => 'ashraktamin678@gmail.com',
'password' => bcrypt('123456'),
'roles_name' => 'admin',
'status' => 'active',

]);

$role = Role::create(['name' => 'admin']);

$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);

$user->assignRole([$role->id]);

}

}
