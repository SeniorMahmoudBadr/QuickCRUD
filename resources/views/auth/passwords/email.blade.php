@extends('auth.layout')

@section('content')
    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
        <!--begin::Form-->
        <form class="form w-100" method="POST" action="{{ route('password.email') }}">
            @csrf
            <!--begin::Heading-->
            <div class="text-center mb-10">
                {{-- <div class="row"> --}}
                    @if (Session::has('status'))
                            <div class="alert alert-success" role="alert">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                {{-- </div> --}}
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-3">هل نسيت كلمة السر ؟</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-500 fw-semibold fs-6">أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور الخاصة بك.</div>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input class="form-control bg-transparent @error('email') is-invalid @enderror" type="email"
                       placeholder="mail@domain.com" name="email" value="{{ old('email') }}" required autocomplete="email"
                       autofocus/>
                    @if ($errors->has('email'))
                       <span class="text-danger">{{ $errors->first('email') }}</span>
                   @endif
                <!--end::Email-->
            </div>
            <!--begin::Actions-->
            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit" class="btn btn-primary me-4">
                    <!--begin::Indicator label-->
                    <span class="indicator-label">إرسال</span>
                    <!--end::Indicator label-->
                </button>
                <a href="{{route('login')}}" class="btn btn-light">إلغاء</a>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
@endsection
