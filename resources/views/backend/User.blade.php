@extends('layouts.pageTemplate', ['hasFilters' => false])

@section('css')
    @parent
    {{-- Put here any extra css content --}}
@endsection

@section('filters')
    <div class="mb-10">
        <label class="form-label fs-6 fw-semibold">Status:</label>
        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                data-placeholder="Select option" data-allow-clear="true"
                data-kt-Page-table-filter="status" data-hide-search="true">
            <option></option>
            <option value="Active">Active</option>
            <option value="Expiring">Expiring</option>
            <option value="Suspended">Suspended</option>
        </select>
    </div>
@endsection

@section('form')
    <div class="row row-cols-1 row-cols-sm-1 rol-cols-md-3 row-cols-lg-3">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3" for="name">
                    <span class="required">{{trans('app.First Name')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" id="first_name" name="first_name" placeholder="{{__('app.Your first name')}}" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3" for="name">
                    <span class="required">{{trans('app.Last Name')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" id="last_name" name="last_name" placeholder="{{__('app.Your last name')}}" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3" for="email">
                    <span class="required">{{trans('app.Email')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="email" class="form-control form-control-solid"
                       id="email" name="email" placeholder="{{__('app.Your email')}}" required/>
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
                       id="password_confirmation" name="password_confirmation" placeholder="{{__('app.Repeat the password')}}"/>
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
