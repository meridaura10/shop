<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PrimarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Client',
                'email' => 'client@app.com',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(['email' => $user['email']], $user);
        }

        $pages = [
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

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
