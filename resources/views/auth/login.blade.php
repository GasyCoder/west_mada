@extends('components.layouts.auth')
@section('title', 'Connexion')
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title">{{__('Connexion')}}</h4>
        <div class="nk-block-des">
            <p>{{__('Access the DashLite panel using your email and passcode.')}}</p>
        </div>
    </div>
</div>
    @if(session('error'))
    <div class="alert alert-icon alert-danger" role="alert"> <em class="icon ni ni-alert-circle"></em>
        <strong>Désolé!
        </strong>.
        {{ session('error') }}
    </div>
    @endif
   <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="default-01">{{__('Email')}}</label>
            </div>
            <div class="form-control-wrap">
                <input type="text" id="email"
                    placeholder="{{__('Enter your email address')}}"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                    required autocomplete="email" autofocus>
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
                @if (Route::has('password.request'))
                <a class="link link-primary link-sm" href="{{ route('password.request') }}">
                    {{__('Oublié mot de passe?')}}</a>
                @endif
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg
                @error('password') is-invalid @enderror" name="password" 
                required autocomplete="current-password" id="password" 
                placeholder="{{__('Saisir votre mot de passe')}}">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
                            : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Souviens de moi') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block">{{__('Se connecter')}}</button>
        </div>
    </form>
    <x-login/>
@endsection