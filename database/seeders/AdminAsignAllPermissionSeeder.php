<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminAsignAllPermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = User::where( 'email', 'admin@admin.com' )->first();
        // Retrieve all available permissions
        $allPermissions = Permission::all();
        // Assign all available permissions to the user
        $user->syncPermissions( $allPermissions );
    }
}
