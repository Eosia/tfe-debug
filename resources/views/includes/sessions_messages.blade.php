<div class="container-fluid my-3">
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif
    </div>
</div>
