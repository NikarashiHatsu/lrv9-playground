<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.components.upload');
    }
}
