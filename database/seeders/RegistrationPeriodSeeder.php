<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistrationPeriod;
use Carbon\Carbon;

class RegistrationPeriodSeeder extends Seeder
{
    public function run(): void
    {
        RegistrationPeriod::create([
            'start_at' => Carbon::parse('2025-07-07 00:00:00'),
            'end_at' => Carbon::parse('2025-07-30 23:59:59'),
            'is_active' => true,
        ]);
    }
}
