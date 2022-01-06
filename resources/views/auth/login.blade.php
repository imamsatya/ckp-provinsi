@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #7367f0">
                <div class="card-header " style="color: white; font-weight: bold;">{{ __('Login') }}</div>

                <div class="card-body" style="background-color: #283046; color: white;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right " style="color: #white;">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input style="background-color: #161d31; color: white; border: 2px solid #7367f0;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right " style="color white;">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input style="background-color: #161d31; color: white; border: 2px solid #7367f0;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color: white;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: #7367f0; color: white;">
                                    {{ __('Login') }}
                                </button>

                                

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="owl">
  <div class="hand"></div>
  <div class="hand hand-r"></div>
  <div class="arms">
    <div class="arm"></div>
    <div class="arm arm-r"></div>
  </div>
</div>
<div class="form">
  <div class="control">
    <label for="email" class="fa fa-envelope"></label>
    <input id="email" placeholder="Email" type="email"></input>
</div>
<div class="control">
  <label for="password" class="fa fa-asterisk"></label>
  <input id="password" placeholder="Password" type="password"></input>
</div>
</div> --}}
@endsection
 {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}