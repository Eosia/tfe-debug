<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Conversation,
    Message,
    Job,
    Proposal,
    CoverLetter,
    User
};

class ProposalController extends Controller
{

    public function store(Request $request, Job $job)
    {
        $jobs = Job::all();
        $users = User::all();
        $coverLetters = CoverLetter::all();

        $proposal = Proposal::create([
            'job_id' => $job->id,
            'validated'=>false
        ]);

        CoverLetter::create([
            'proposal_id' => $proposal->id,
            'content' => $request->input('content')
        ]);

        $success = "Votre candidature a bien été envoyée !";

        return redirect()->route('panel.index')->withSuccess($success);
    }

    public function confirm(Request $request)
    {
        $proposal = Proposal::findOrFail($request->proposal);

        abort_if($proposal->job->user->id !== auth()->user()->id, 403 );

        $proposal->fill(['validated'=>1]);

        if($proposal->isDirty())
        {

            $proposal->save();

            $conversation = Conversation::create([
                'from' => auth()->user()->id,
                'to' => $proposal->user->id,
                'job_id' =>$proposal->job_id
            ]);

            Message::create([
                'user_id' => auth()->user()->id,
                'conversation_id' => $conversation->id,
                'content' => 'Bonjour, j\'ai validé votre candidature'
            ]);

            $success = "La candidature a bien été validé";
            return redirect()->route('panel.index')->withSuccess($success);

        }
    }

    public function index()
    {
        $proposals = auth()->user()->proposals()->get();

        return view('panel.index', compact('proposals'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
        abort_if($proposal->job->user->id !== auth()->user()->id, 403 );

        $proposal->delete();

        $success = "La candidature a été supprimée";

        return redirect()->route('panel.index')->withSuccess($success);

    }


}
