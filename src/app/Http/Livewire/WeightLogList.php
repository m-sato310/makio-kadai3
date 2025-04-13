<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class WeightLogList extends Component
{
    use WithPagination;

    protected $listeners = ['logUpdated' => '$refresh'];

    public function render()
    {
        $logs = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('livewire.weight-log-list', [
            'logs' => $logs
        ]);
    }
}
