<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Role::create(['id'=>1,'name' => 'DS']);
        Role::create(['id'=>2,'name' => 'ADS']);
        Role::create(['id'=>3,'name' => 'ADP']);
        Role::create(['id'=>4,'name' => 'Accountant']);
        Role::create(['id'=>5,'name' => 'AO']);
        Role::create(['id'=>6,'name' => 'ADR']);
        Role::create(['id'=>7,'name' => 'SSO']);
        Role::create(['id'=>8,'name' => 'DO']);
        Role::create(['id'=>9,'name' => 'EDO']);
        Role::create(['id'=>10,'name' => 'ICTA']);
        Role::create(['id'=>11,'name' => 'MSO']);
        Role::create(['id'=>12,'name' => 'CO']);
        Role::create(['id'=>13,'name' => 'FI']);

        Permission::create(['id'=>10,'name' => 'Super Admin']);

        Permission::create(['id'=>20,'name' => 'Person & Household Admin']);
        Permission::create(['id'=>21,'name' => 'Person & Household']);
        Permission::create(['id'=>22,'name' => 'Person & Household Operator']);
        
        Permission::create(['id'=>50,'name' => 'Consumable Admin']);
        Permission::create(['id'=>51,'name' => 'Consumable']);
        
        Permission::create(['id'=>30,'name' => 'Attendance Admin']);
        Permission::create(['id'=>31,'name' => 'Attendance']);

        Permission::create(['id'=>40,'name' => 'Samurdhi Admin']);
        Permission::create(['id'=>41,'name' => 'Samurdhi']);
            
        $user = User::create([
            'id'=>1001,
            'name'=>'Nashath Nasik',
            'email'=>'mail2snasik@gmail.com',
            'password'=>'$2y$10$PxO3YAJJJwQbwzQ3d/ymnejoFrxnFSXehYAuYovjyTNApgBQLQO9m'
        ]);

        $user->assignRole(['ICTA']);
        $user->givePermissionTo('Super Admin');
        

    }
}
