@extends('components.layouts.auth')
@section('title', 'Inscription')
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title">{{__('Créer un compte')}}</h4>
        <div class="nk-block-des">
            <p>{{__('Access the DashLite panel using your email and passcode.')}}</p>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01">{{__('Nom')}}</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" id="name" placeholder="{{__('Votre Nom')}}"
                class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01">{{__('Email')}}</label>
        </div>
        <div class="form-control-wrap">
            <input type="email" id="email" placeholder="{{__('Enter your email address')}}"
                class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">{{__('Mot de passe')}}</label>
        </div>
        <div class="form-control-wrap">
            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" class="form-control form-control-lg
                @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                id="password" placeholder="{{__('Saisir votre mot de passe')}}">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">{{__('Confirmer mot de passe')}}</label>
        </div>
        <div class="form-control-wrap">
            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password-confirm">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" 
                required autocomplete="new-password" placeholder="{{__('Confirmer mot de passe')}}">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">{{__('S\'inscrire')}}</button>
    </div>
</form>
<div class="text-center pt-4 pb-3">
    <h6 class="overline-title overline-title-sap">
        <span>OR</span>
    </h6>
</div>
<ul class="nav justify-center gx-4">
    <li class="nav-item">
        <a class="nav-link" href="#">Google</a>
    </li>
</ul>
@endsection