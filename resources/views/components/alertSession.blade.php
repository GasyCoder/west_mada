@if (session('success'))
<div class="alert alert-fill alert-success alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em>
    <strong>Succès,</strong> {{ session('success') }}
    <button class="close" data-bs-dismiss="alert">
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-fill alert-danger alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em>
    <strong>Désolé,</strong> {{ session('error') }} 
    <button class="close" data-bs-dismiss="alert">
    </button>
</div>
@endif


@if (session('warning'))
<div class="alert alert-fill alert-warning alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em>
    <strong>Attention,</strong> {{ session('warning') }}
    <button class="close" data-bs-dismiss="alert">
    </button>
</div>
@endif


@if (session('info'))
<div class="alert alert-fill alert-info alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em>
    <strong>Info,</strong> {{ session('info') }}
    <button class="close" data-bs-dismiss="alert">
    </button>
</div>
@endif