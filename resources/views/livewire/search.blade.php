<div class="serch-navbar">
    <div class="inline-block my-auto ml-3 mr-5"
         x-data="{ open: true }" x-on:click.away="open = false; @this.resetIndex();" x-on:keydown.escape="open = false; @this.resetIndex();" >
        {{-- Do your work, then step back. --}}
        <input class="bg-gray-100 text-gray-900 border-2 px-3 py-2 w-64 rounded-full focus:outline-none placeholder-gray-500"
               placeholder="&#x1F50D; Rechercher un job ..."
               @click.prevent="open = true"
               wire:model="query"
               wire:keydown.prevent.arrow-down="incrementIndex()"
               wire:keydown.prevent.arrow-up="decrementIndex()"
               wire:keydown.prevent.enter="selectIndex()"
               wire:keydown.backspace="resetIndex()"
        />

        <div class="absolute bg-gray-200 text-md w-64 mt-1 border rounded">

            @if(strlen($this->query)>2)
                <div class="px-3 py-2" x-show="open">
                    @if(count($jobs)>0)
                        @foreach($jobs as $index => $job)
                            <p class="text-green-600 {{ ($index == $selectedIndex) ? 'text-blue-600' : '' }}">
                                <i class="fa-solid fa-check mr-1"></i> {{ $job->title }}
                            </p>
                        @endforeach

                    @else
                        <span class="text-red-600">
                        <i class="fa-solid fa-x mr-1"></i>
                        0 Résultats pour "{{ $query }}"
                </span>
                    @endif
                </div>

            @endif

        </div>

    </div>
</div>

