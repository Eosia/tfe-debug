<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Job extends Component
{

    public $job;

    public function addLike()
    {

        if(auth()->check())
        {
            auth()->user()->likes()->toggle($this->job->id);

        }

        else {
            $this->emit('flash-message', 'Merci de vous connecter pour ajouter un job dans vos favoris.', 'error');
            return;
        }

    }

    public function render()
    {
        return view('livewire.job');
    }
}
