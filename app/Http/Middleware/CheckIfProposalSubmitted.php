<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfProposalSubmitted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $job = $request->job->id;

        if (auth()->user()->proposals->contains('job_id', $job)) {

            $success = "Vous avez déjà soumis votre candidature pour cette annonce !";

            return redirect()->route('home.index')->withSuccess($success);
        }

        return $next($request);
    }
}
