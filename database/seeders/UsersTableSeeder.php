<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Create a Faker instance
        $count = 0; // Initialize a counter

        while ($count < 50) { // Add users until we reach 50
            $email = $faker->unique()->safeEmail; // Generate a unique email

            try {
                User::create([
                    'name' => $faker->name,
                    'email' => $email, // Use the generated unique email
                    'password' => bcrypt('password123'), // or bcrypt($faker->password) for random
                    'status' => 0, // Assuming default status is 0
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $count++; // Increment the counter for each successfully added user
            } catch (\Exception $e) {
                // Handle exception (e.g., log it or ignore duplicates)
                // You can log the error if needed for debugging
                \Log::error('User creation failed: ' . $e->getMessage());
            }
        }
    }
}
