<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class Search extends Component
{


    public String $query = '' ;
    public $jobs = [];
    public Int $selectedIndex = 0;

    public function incrementIndex()
    {
        if ($this->selectedIndex === (count($this->jobs) - 1))
        {
            $this->selectedIndex = 0;
            return;
        }
        $this->selectedIndex++;
    }

    public function decrementIndex()
    {
        if ($this->selectedIndex === 0)
        {
            $this->selectedIndex = count($this->jobs) - 1;
            return;
        }

        $this->selectedIndex--;
    }

    public function updatedQuery()
    {
        if (strlen($this->query) > 2 ) {
            $words = '%' . $this->query . '%';

            $this->jobs = Job::where('title', 'like', $words)
                ->orWhere('description', 'like', $words)
                ->get();
        }

    }

    public function selectIndex()
    {
        if ($this->jobs->isNotEmpty()) {
            $this->redirect(route('jobs.show', $this->jobs[$this->selectedIndex]['slug']));
        }
    }

    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }



    public function render()
    {
        return view('livewire.search');
    }
}
