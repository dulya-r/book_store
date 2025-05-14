<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Database\Seeders\AdminUserSeeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        
        $this->call(AdminUserSeeder::class);

        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

