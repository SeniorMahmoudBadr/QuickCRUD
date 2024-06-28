@extends('layouts.pageTemplate', ['hasFilters' => true])

@section('title', )

@section('css')
    @parent
    {{-- Put here any extra css content --}}
@endsection

@section('titleContainer')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('subpage')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('filters')
    <div class="row mb-5">
        <div class="col">
            <label for="status_search" class="form-label">{!! __('app.Status') !!}</label>
            <select class="form-select form-select-solid" id="status_search" data-allow-clear="true"
                    data-hide-search="true" data-control="select2"
                    data-placeholder="{!! __('app.Select an Option') !!}">
                <option></option>
                <option value="approved">{!! __('app.Approved') !!}</option>
                <option value="suspended">{!! __('app.Suspended') !!}</option>
            </select>
        </div>
    </div>
@endsection

@section('form')
    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
        <!--begin::Col-->
        <div class="col-lg-6">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3" for="name">
                    <span class="required">{{trans('app.Name')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" id="name" name="name"
                       placeholder="{{__('app.Name')}}" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->

        <!--begin::Col-->
        <div class="col-lg-6">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3" for="email">
                    <span class="required">{{trans('app.Email')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="email" class="form-control form-control-solid"
                       id="email" name="email" placeholder="{{__('app.Email')}}" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label for="password" class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">{{trans('app.Password')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="password" class="form-control form-control-solid"
                       id="password" name="password" placeholder="{{__('app.Enter a strong password')}}"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label for="password_confirmation" class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">{{trans('app.Confirm Password')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="password" class="form-control form-control-solid"
                       id="password_confirmation" name="password_confirmation"
                       placeholder="{{__('app.Repeat the password')}}"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
    </div>
@endsection

@section('content')
    @parent
    {{-- Put here any extra html content --}}
@endsection

@section('js')
    @parent
@endsection
