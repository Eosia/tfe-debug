<div class="my-5 mx-auto">
    <div class="max-w-full mx-2">
        <h1 class="text-xl font2 color1 text-center mb-5">Stage : {{ $conversation->job->title }}</h1>

        @foreach($conversation->messages as $message)

                <div class="rounded-lg p-2 mb-5 font-medium col-12 col-sm-12 col-md-11 col-lg-6 col-xl-5
                {{ $message->user->id === auth()->user()->id  ? 'align-items-start rounded-bl-none bg-blue-500 text-white'
                        : ' rounded-br-none ml-auto bg-gray-500 text-white align-items-end'}}">
                    <div class="mt-2 mb-1 py-2 px-3 rounded-2xl text-white text-left mr-5
                    ">
                        {{ $message->content }}
                        <br>
                        <p class="font-thin mt-2">
                            {{ $message->user->id === auth()->user()->id  ?
                                'Vous avez dit : ' : $message->user->firstname. ' ' .$message->user->lastname. ' a dit :'}}
                            <span class="font-thin mt-2">
                        {{ $message->created_at->diffForHumans() }}
                    </span>
                        </p>
                    </div>
                </div>

        @endforeach
        <br>
        <p class="mt-5">Appuyer sur entrer ou cliquer sur le bouton pour envoyer votre message</p>
        <textarea wire:model="message" wire:keydown.enter.prevent="sendMessage" class="border rounded px-3 py-4 mt-3 my-2 shadow-md w-full"></textarea>

        <button class="btn btn-md btn-primary px-3 py-2 mb-5
        @if(auth()->check() && auth()->user()->suspended != 0 ) 
                    disabled 
                    @endif"  wire:click.prevent="sendMessage">
            Envoyer
        </button>
    </div>
</div>

