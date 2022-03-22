<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name' => "Super admin",
            'email' => "admin@admin.com",
            'is_admin' => "1",
            'email_verified_at' => now(),
            'password' => '$2y$10$iDWOBgtDVdioR/1wEnhLnua3pnBlt2OsAdmFUbR4z0Wp./Ip7GrR.', // 123456
            'remember_token' => Str::random(10),
        ]);
        \App\Models\School::factory(10)->create();
        \App\Models\Student::factory(10)->create();
    }
}
