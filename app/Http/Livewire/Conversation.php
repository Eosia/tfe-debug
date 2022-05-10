<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\{
    Message
};

class Conversation extends Component
{

    use AuthorizesRequests;

    public $conversation;
    public $job;
    public $message;
    protected $listeners = ['sent' => '$refresh'];

    public function mount($conversation)
    {
        $this->conversation = $conversation;
        $this->job = $conversation->job;
        return view('conversations.show');
    }

    public function sendMessage()
    {
        Message::create([
            'user_id' => auth()->user()->id,
            'conversation_id' => $this->conversation->id,
            'content' => $this->message
        ]);

        $this->reset('message');
        $this->emit('sent');
    }

    public function render()
    {
        return view('livewire.conversation');
    }

}
