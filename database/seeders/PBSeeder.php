<?php

namespace Database\Seeders;

use App\Models\PB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PB::create([
            'first_name' => 'Joanne',
            'last_name' => 'Doe',
            'phone_number' => '+62' . rand(10000000000, 99999999999),
            'email' => 'joanne@example.com',
            'password' => bcrypt('password'),
            'referral_code' => Str::upper(Str::random(6)),
            'area' => 'Jakarta',
            'born_place' => 'Jakarta',
            'bod' => '2000-01-01',
            'religion' => 'Islam',
            'graduate' => 'SMA',
            'ktp_address' => 'Jakarta',
            'bank_account_number' => '123456789',
            'bank_account_name' => 'John Doe',
            'bank_name' => 'BNI',
            'join_date' => '2020-01-01',
            'partner_status' => 'active',
            'ktp_number' => '123456789',
            'kk_number' => '123456789',
            'skck_number' => '123456789',
            'ktp_path_doc' => 'ktp.jpg',
            'kk_path_doc' => 'kk.jpg',
            'skck_path_doc' => 'skck.jpg',
            'selfie_path' => 'selfie.jpg',
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null,
            'deleted_at' => null,
            'deleted_reason' => null,
        ]);
    }
}
