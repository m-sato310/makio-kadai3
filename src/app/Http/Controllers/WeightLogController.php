<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function registerStep2Form()
    {
        return view('auth.register-step2');
    }

    public function registerStep2Store(RegisterStep2Request $request)
    {
        $user = Auth::user();

        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d'),
            'weight' => $request->current_weight
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight
        ]);

        return redirect('/weight_logs');
    }
}
