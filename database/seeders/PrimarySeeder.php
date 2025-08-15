<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrimarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'Product',
            'Term',
            'Page',
            'Article',
            'Role',
            'User',
            'Order',
        ];

        $modelPermissions = ['viewAny', 'view', 'create', 'update', 'delete'];

        $defaultPermissions = ['admin.auth'];

        $rolesPermissions = [
            'admin' => ['*'],
            'manager' => [
                'Product' => ['*'],
                'Page' => ['*'],
                'Article' => ['*'],
                'Term' => ['*'],
                'Order'   => ['viewAny', 'view', 'update'],
                '__extra' => [],
            ],
            'viewer' => [
                'Product' => ['viewAny', 'view'],
                'Term'    => ['viewAny', 'view'],
                'Page'    => ['viewAny', 'view'],
                'Article' => ['viewAny', 'view'],
                'Role'    => ['viewAny', 'view'],
                '__extra' => []
            ],
        ];

        $allPermissions = [];

        foreach ($defaultPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $allPermissions[] = $permission;
        }

        $modelPermMap = [];
        foreach ($models as $model) {
            $modelLower = strtolower($model);
            $modelPermMap[$model] = [];

            foreach ($modelPermissions as $action) {
                $permissionName = "{$modelLower}.{$action}";
                Permission::firstOrCreate(['name' => $permissionName]);
                $allPermissions[] = $permissionName;
                $modelPermMap[$model][] = $permissionName;
            }
        }

        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            if ($permissions === ['*']) {
                $role->syncPermissions($allPermissions);
                continue;
            }

            $assigned = [];

            foreach ($permissions as $model => $actions) {
                if ($model === '__extra') {
                    foreach ($actions as $perm) {
                        Permission::firstOrCreate(['name' => $perm]);
                        $assigned[] = $perm;
                    }
                    continue;
                }

                if ($actions === ['*'] && isset($modelPermMap[$model])) {
                    $assigned = array_merge($assigned, $modelPermMap[$model]);
                    continue;
                }

                foreach ($actions as $action) {
                    $perm = strtolower($model) . '.' . $action;
                    Permission::firstOrCreate(['name' => $perm]);
                    $assigned[] = $perm;
                }
            }

            $role->syncPermissions([...$assigned, ...$defaultPermissions]);
        }

        $usersData = [
            [
                'name' => 'Admin',
                'email' => 'Admin@app.com',
                'password' => Hash::make('password'),
                'roles' => ['admin'],
            ],
            [
                'name' => 'Manager',
                'email' => 'Manager@app.com',
                'password' => Hash::make('password'),
                'roles' => ['manager'],
            ],
            [
                'name' => 'Client',
                'email' => 'Client@app.com',
                'password' => Hash::make('password'),
                'phone' => '380995088087',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::query()->updateOrCreate(['email' => $userData['email']], [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'] ?? null,
                'password' => 'password',
            ]);

            if(!array_key_exists('roles', $userData)) {
                continue;
            }

            $user->assignRole($userData['roles']);
        }

        $pagesData = [
            [
                'name' => 'Головна',
                'slug' => 'home',
            ],
            [
                'name' => 'Про нас',
                'slug' => 'about',
            ],
            [
                'name' => 'Політика конфіденційності',
                'slug' => 'policy',
            ],
            [
                'name' => 'Доставка і оплата',
                'slug' => 'delivery',
            ],
        ];

        foreach ($pagesData as $pageData) {
            Page::query()->updateOrCreate(['slug' => $pageData['slug']], $pageData);
        }
    }
}
