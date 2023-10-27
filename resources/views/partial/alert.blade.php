@if (session('success'))
<div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if (session('info'))
<div class="col-md-12">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if (session('warning'))
<div class="col-md-12">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($errors->success->any())
    <div class="col-md-12">
    @foreach ($errors->success->all() as $error)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

@if ($errors->info->any())
    <div class="col-md-12">
    @foreach ($errors->info->all() as $error)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

@if ($errors->warning->any())
    <div class="col-md-12">
    @foreach ($errors->warning->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

@if ($errors->danger->any())
    <div class="col-md-12">
    @foreach ($errors->danger->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
