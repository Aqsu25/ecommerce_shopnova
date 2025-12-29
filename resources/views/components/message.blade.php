@if (session()->has('error'))
    <div class="alert alert-danger">
        {{-- <i class="fa-solid fa-xmark"></i>&nbsp;&nbsp; --}}
        {{ session('error') }}
    </div>
@endif


@if (session()->has('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-check">&nbsp;&nbsp;</i>{{ session('success') }}
    </div>
@endif
