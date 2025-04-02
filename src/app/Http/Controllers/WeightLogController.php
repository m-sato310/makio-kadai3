<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWeightLogRequest;
use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\UpdateTargetRequest;
use App\Http\Requests\UpdateWeightLogRequest;
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

    public function index()
    {
        $user = Auth::user();

        $latestWeightLog = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->first();

        $target = WeightTarget::where('user_id', $user->id)->first();

        $logs = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->paginate(8);

        return view('weight_logs.index', compact('latestWeightLog', 'target', 'logs'));
    }

    public function store(CreateWeightLogRequest $request)
    {
        $user = auth()->user();

        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content
        ]);

        return redirect('/weight_logs');
    }

    public function search(Request $request)
    {
        $user = auth()->user();

        $query = WeightLog::where('user_id', $user->id);

        if ($request->filled('from')) {
            $query->where('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('date', '<=', $request->to);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $latestWeightLog = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->first();

        $target = WeightTarget::where('user_id', $user->id)->first();

        $fromText = $request->from ?: '指定なし';
        $toText = $request->to ?: '指定なし';
        $searchMessage = "{$fromText}~{$toText}の検索結果 {$logs->total()}件";

        return view('weight_logs.index', compact('logs','latestWeightLog', 'target', 'searchMessage'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $log = WeightLog::where('user_id', $user->id)->find($id);

        return view('weight_logs.edit', compact('log'));
    }

    public function update(UpdateWeightLogRequest $request, $id)
    {
        $log = WeightLog::where('user_id', auth()->id())->find($id);

        $log->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content
        ]);

        return redirect('/weight_logs');
    }

    public function destroy($id)
    {
        $log = WeightLog::where('user_id', auth()->id())->find($id);
        $log->delete();

        return redirect('/weight_logs');
    }

    public function goalSettingForm()
    {
        $target = WeightTarget::where('user_id', auth()->id())->first();
        return view('weight_logs.goal_setting', compact('target'));
    }

    public function goalSettingUpdate(UpdateTargetRequest $request)
    {
        $target = WeightTarget::where('user_id', auth()->id())->first();

        $target->update([
            'target_weight' => $request->target_weight,
        ]);

        return redirect('/weight_logs');
    }
}
