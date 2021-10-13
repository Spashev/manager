<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FeedbackStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = Role::create(['name' => 'manager']);
        $user = Role::create(['name' => 'user']);

        $create = Permission::create(['name' => 'create']);
        $edit = Permission::create(['name' => 'edit']);
        $delete = Permission::create(['name' => 'delete']);
        $show = Permission::create(['name' => 'show']);
        $list = Permission::create(['name' => 'list']);
        $manager_create = Permission::create(['name' => 'manager-create']);
        $manager_edit = Permission::create(['name' => 'manager-edit']);
        $manager_delete = Permission::create(['name' => 'manager-delete']);
        $manager_show = Permission::create(['name' => 'manager-show']);
        $manager_list = Permission::create(['name' => 'manager-list']);

        $manager->givePermissionTo($create);
        $manager->givePermissionTo($edit);
        $manager->givePermissionTo($delete);
        $manager->givePermissionTo($show);
        $manager->givePermissionTo($list);
        $manager->givePermissionTo($manager_create);
        $manager->givePermissionTo($manager_edit);
        $manager->givePermissionTo($manager_delete);
        $manager->givePermissionTo($manager_show);
        $manager->givePermissionTo($manager_list);

        $create->assignRole($manager);
        $edit->assignRole($manager);
        $delete->assignRole($manager);
        $show->assignRole($manager);
        $list->assignRole($manager);
        $manager_create->assignRole($manager);
        $manager_edit->assignRole($manager);
        $manager_delete->assignRole($manager);
        $manager_show->assignRole($manager);
        $manager_list->assignRole($manager);

        $user->givePermissionTo($create);
        $user->givePermissionTo($edit);
        $user->givePermissionTo($delete);
        $user->givePermissionTo($show);

        $create->assignRole($user);
        $edit->assignRole($user);
        $delete->assignRole($user);
        $show->assignRole($user);

        $user = User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('1q2w3e4r'),
        ]);
        $user->assignRole('manager');


        FeedbackStatus::create(['title' => 'new']);
        FeedbackStatus::create(['title' => 'processing']);
        FeedbackStatus::create(['title' => 'processed']);
        FeedbackStatus::create(['title' => 'error']);
    }
}
