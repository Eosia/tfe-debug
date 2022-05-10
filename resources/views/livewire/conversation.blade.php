<div class="my-5 mx-auto">
    <div class="max-w-full mx-2">
        <h1 class="text-xl font2 color1 text-center mb-5">Stage : {{ $conversation->job->title }}</h1>

        @foreach($conversation->messages as $message)

                ok

        @endforeach
        <br>
        <p class="mt-5">Appuyer sur entrer ou cliquer sur le bouton pour envoyer votre message</p>
        <textarea wire:model="message" wire:keydown.enter.prevent="sendMessage" class="border rounded px-3 py-4 mt-3 my-2 shadow-md w-full"></textarea>

        <button class="btn btn-md btn-primary px-3 py-2 mb-5"  wire:click.prevent="sendMessage">
            Envoyer
        </button>
    </div>
</div>

