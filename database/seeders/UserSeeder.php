<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultAdmin = [
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now()->subYears(5),
            'password' => Hash::make('Password'),
            'remember_token' => Str::random(10),
            'city' => 'Perth',
            'state' => 'WA'
        ];

        $seedUsers = [
            [
                'id' => null,
                'name' => 'Freida Livery',
                'email' => 'Freida.Livery@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password1'),
                'remember_token' => Str::random(10),
                'city' => 'Adelaide',
                'state' => 'SA',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Jaqueline Hyde',
                'email' => 'Jaqueline.Hyde@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password2'),
                'remember_token' => Str::random(10),
                'city' => 'Gold Coast',
                'state' => 'QLD',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Lyle Bull',
                'email' => 'Lyle.Bull@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password3'),
                'remember_token' => Str::random(10),
                'city' => 'Hobart',
                'state' => 'TAS',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Russell Cattle',
                'email' => 'Russell.Cattle@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password4'),
                'remember_token' => Str::random(10),
                'city' => 'Launceston',
                'state' => 'TAS',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Isolde House',
                'email' => 'Isolde.House@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password5'),
                'remember_token' => Str::random(10),
                'city' => 'Canberra',
                'state' => 'ACT',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Flo Chart',
                'email' => 'Flo.Chart@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password6'),
                'remember_token' => Str::random(10),
                'city' => 'Alice Springs',
                'state' => 'NT',
                'created_at' => now(),
            ],

            [
                'id' => null,
                'name' => 'Terry Bull',
                'email' => 'Terry Bull@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('Password7'),
                'remember_token' => Str::random(10),
                'city' => 'Wagga Wagga',
                'state' => 'NSW',
                'created_at' => now(),
            ],

        ];

        $adminRole = Role::whereName('Administrator')->get();
        $clientRole = Role::whereName('Client')->get();

        $admin = User::create($defaultAdmin);
        $admin->assignRole($adminRole);

        foreach ($seedUsers as $seedUser) {
            $user = User::create($seedUser);
            $user->assignRole($clientRole);
        }
    }
}
