<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('1111'),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => 65.5,
        ]);

        WeightLog::factory(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
