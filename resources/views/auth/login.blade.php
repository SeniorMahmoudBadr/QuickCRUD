@extends('auth.layout')

@section('content')
    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
        <!--begin::Form-->
        <form class="form w-100" action="{{ route('login') }}" method="POST">
            @csrf
            <!--begin::Heading-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-primary fw-bolder mb-3">{{__('app.Sign In')}}</h1>
                <!--end::Title-->
            </div>

            @if (session()->has('suspension-error'))
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        <li>{{ session()->get('suspension-error') }}</li>
                    </ul>
                </div>
            @endif

            <!--begin::Heading-->

            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input class="form-control bg-transparent @error('email') is-invalid @enderror"
                       placeholder="Email Address"
                       type="text" id="email" name="email" autocomplete="off" value="{{ old('email') }}" required
                       autofocus/>
                <span class="text-muted">email: admin@example.com</span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!--end::Email-->
            </div>
            <!--end::Input group=-->
            <div class="fv-row mb-3">
                <!--begin::Password-->
                <input class="form-control bg-transparent @error('password') is-invalid @enderror"
                       placeholder="Password"
                       type="password" name="password" required autocomplete="off"/>
                <span class="text-muted">pass: password</span>
                <!--end::Input-->
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!--end::Password-->
            </div>
            <!--end::Input group=-->
            @if (Route::has('password.request'))
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div class="form-check mt-1">
                        <input name="remember" class="form-check-input" type="checkbox" value="1" id="remember-me" />
                        <label class="form-check-label" for="remember-me">
                            {{ __('app.Remember Me') }}
                        </label>
                    </div>
                    <!--begin::Link-->
                    <a href="{{route('password.request')}}" class="link-primary">{{ __('app.Forgot Your Password?') }}</a>
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->
            @endif
            <!--begin::Submit button-->
            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    <!--begin::Indicator label-->
                    <span class="indicator-label">{{__('app.Sign In')}}</span>
                    <!--end::Indicator label-->
                </button>
            </div>
            <!--end::Submit button-->
            @if(Route::has('register'))
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                    <a href="{{route('register')}}" class="link-primary">Sign up</a>
                </div>
                <!--end::Sign up-->
            @endif
        </form>
        <!--end::Form-->
    </div>
@endsection
