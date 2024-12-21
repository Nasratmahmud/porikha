<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Array of permissions to be created
        $permissions = [
            'journal'    => [
                'journal menu',
                'create journal',
                'edit journal',
                'delete journal',
            ],
            'jobpost'    => [
                'jobpost menu',
                'create jobpost',
                'edit jobpost',
                'delete jobpost',
                'recruter dashboard'
            ],

            'forum'      => [
                'forum menu',
                'create forum',
                'delete forum',
            ],
            'category'   => [
                'category menu',
                'create category',
                'edit category',
                'delete category',
            ],
            'bundle'     => [
                'bundle menu',
                'create bundle',
                'edit bundle',
                'delete bundle',
            ],
            'course'     => [
                'course menu',
                'create course',
                'edit course',
                'delete course',
            ],
            'quiz'       => [
                'quiz menu',
                'create quiz',
                'edit quiz',
                'delete quiz',
            ],
            'promo'      => [
                'promo code menu',
                'create promo code',
                'edit promo code',
                'delete promo code',
            ],
            'book'       => [
                'book menu',
                'create book',
                'edit book',
                'delete book',
            ],
            'guide'      => [
                'guide menu',
                'create guide',
                'edit guide',
                'delete guide',
            ],
            'setting'    => [
                'system setting',
                'profile setting',
                'social setting',
            ],
            'permission' => [
                'permission menu',
                'user permission',
            ],
            'admin'      => [
                'super admin',
            ],
        ];

        // Loop through the permissions array and create each permission
        foreach ( $permissions as $group => $groupPermissions ) {
            foreach ( $groupPermissions as $permission ) {
                Permission::create( ['name' => $permission, 'group_name' => $group] );
            }
        }
    }
}
