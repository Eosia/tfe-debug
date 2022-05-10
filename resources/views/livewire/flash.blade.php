<div class="d-block">
    <div x-data="{ open: false }" x-on:flash.window="open = true; window.scrollTo(0, 0); setTimeout(() => open = false, 5000);" x-cloak>
        <div x-show.transition.opacity="open" class="{{ $styleByType[$type] }} border rounded mb-3" role="alert" x-cloak>
            <div class="flex justify-center align-middle p-5">
                <p class="px-3 py-2 rounded {{ $styleByType[$type] }}">
                    <i class="fa-solid fa-triangle-exclamation fa-2x text-red-700 mr-3"></i>
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
</div>
