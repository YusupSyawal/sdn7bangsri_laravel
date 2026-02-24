<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SchoolProfile;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin default tanpa duplikasi
        User::firstOrCreate(
            ['email' => 'admin@sdn7bangsri.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Buat profil sekolah default tanpa duplikasi
        SchoolProfile::firstOrCreate(
            ['email' => 'sekretariat@sdn7bangsri.sch.id'],
            [
                'school_name' => 'SD Negeri 7 Bangsri',
                'welcome_message' => 'Dimana anak-anak tersenyum bahagia 😊',
                'vision' => 'To create a nurturing environment where every child discovers their unique talents and develops a lifelong love for learning.',
                'mission' => 'To provide quality education that fosters creativity, critical thinking, and character development in a safe and supportive atmosphere.',
                'values' => 'Respect, integrity, excellence, and compassion guide everything we do. We believe in building strong foundations for future success.',
                'approach' => 'Hands-on learning, individualized attention, and innovative teaching methods that make education engaging and fun for all students.',
                'address' => 'Jl. Juwangi RT 02 RW 07, Kecamatan Bangsri, Kabupaten Jepara, Jawa Tengah 59453',
                'phone' => '(0291) 123456',
                'school_hours' => 'Senin - Sabtu: 07:00 AM - 12:00 PM. After School Care: 3:00 PM - 6:00 PM'
            ]
        );
    }
}