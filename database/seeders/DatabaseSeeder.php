<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Routing\Route;
use function Pest\Laravel\seed;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Qusay SuperAdmin',
            'email' => 'kosaykm71@gmail.com',
            'password' => Hash::make('321321321'),
        ]);

        $role = Role::create(['name' => 'Super Admin']);


        $this->call(PermissionSeeder::class);

        $user = User::where('email' , 'kosaykm71@gmail.com')->first();
        $role = Role::find(1);

        $permissionIds = Permission::pluck('id');
        $role->syncPermissions($permissionIds);

        $user->assignRole('Super Admin') ;

    }
}
