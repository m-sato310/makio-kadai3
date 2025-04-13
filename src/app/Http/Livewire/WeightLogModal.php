<?php

namespace App\Http\Livewire;

use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WeightLogModal extends Component
{
    public $isOpen = false;

    public $date;
    public $weight;
    public $calories;
    public $exercise_time;
    public $exercise_content;

    protected $rules = [
        'date' => 'required|date',
        'weight' => 'required|numeric|between:0,999.9',
        'calories' => 'required|numeric',
        'exercise_time' => 'required',
        'exercise_content' => 'nullable|max:120',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->reset(['isOpen', 'date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
    }

    public function save()
    {
        $this->validate();

        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $this->date,
            'weight' => $this->weight,
            'calories' => $this->calories,
            'exercise_time' => $this->exercise_time,
            'exercise_content' => $this->exercise_content,
        ]);

        $this->closeModal();
        $this->emit('logUpdated');
    }

    public function render()
    {
        return view('livewire.weight-log-modal');
    }
}
