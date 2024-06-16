<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '082121212121',
            'password' => Hash::make('admin'),
            'role' => Role::ADMIN->status(),
        ]);
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Kepala Bidang',
            'email' => 'kabid@example.com',
            'phone' => '082121212121',
            'password' => Hash::make('password'),
            'role' => Role::OPERATOR->status(),
        ]);
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Kepala Sub Bagian',
            'email' => 'kasubag@example.com',
            'phone' => '082121212121',
            'password' => Hash::make('password'),
            'role' => Role::OPERATOR->status(),
        ]);
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Kepala Dinas',
            'email' => 'kadis@example.com',
            'phone' => '082121212121',
            'password' => Hash::make('password'),
            'role' => Role::OPERATOR->status(),
        ]);
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Seketari Kepala Dinas',
            'email' => 'sekdis@example.com',
            'phone' => '082121212121',
            'password' => Hash::make('password'),
            'role' => Role::OPERATOR->status(),
        ]);
        User::factory()->create([
            'name' => fake()->name(),
            'jabatan' => 'Staff',
            'email' => 'staff@example.com',
            'phone' => '082121212121',
            'password' => Hash::make('password'),
            'role' => Role::STAFF->status(),
        ]);
    }
}
