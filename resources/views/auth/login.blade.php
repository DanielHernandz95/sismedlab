@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
@if(Session::has('jsAlert'))

<script type="text/javascript" >
    alert({{ session()->get('jsAlert') }});
</script>

@endif
    <div class="form_login"  style="border: 1px solid #8FB542">
        <legend class="tama_letra_login" style="margin-left: 32%">INICIO SESIÓN</legend>

        <div class="forceColor"></div>
        <div class="topbar" >
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input id="email" type="email" style="height: 30px" placeholder="USUARIO" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password" type="password" style="height: 30px"  placeholder="CONTRASEÑA" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <hr>
            <div class="form-group row mb-0">
                <div style="width: 200px; margin-left: -25px;">
                    <button type="submit" class="login_btn" style="height: 35px" >
                        {{ __('Iniciar sesión') }}
                    </button>
                </div>
                <div class="col-md-3 offset-md-1">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" style="color: #161616" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
