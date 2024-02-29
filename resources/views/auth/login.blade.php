@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #f8fafc;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="border-color: #102d4b;">
                    <div class="card-header" style="background-color: #89bcb8; color: white; font-size: 20px; font-weight: bold;">{{ __('Login') }}</div>

                    <div class="card-body" style="background-color: #cad5df;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: #102d4b;">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #f0f4f8;">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label" style="color: #102d4b;">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: #f0f4f8;">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" style="background-color: #102d4b; color: #f8fafc;">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
