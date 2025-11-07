<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            ['nome' => 'Pendente', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Concluído', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
