<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Conversation,
    Message,
    Proposal,
    User
};

class ConversationController extends Controller
{
    //

    public function index()
    {
        $conversations = auth()->user()->conversations()->latest()->get();

        return view('conversations.index', [
            'conversations' => $conversations
        ]);

    }

    public function show(Conversation $conversation)
    {
        abort_if($conversation->from !== auth()->user()->id && $conversation->to !== auth()->user()->id , 403 );

        $user = auth()->user();
        return view('conversations.show', [
            'conversation' => $conversation,
            'user' => $user
        ]);
    }
}