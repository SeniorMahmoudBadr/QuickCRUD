@extends('layouts.pageTemplate', ['hasFilters' => true])

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

@section('titleContainer')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('subpage')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('form')
    <input type="hidden" name="category_id" value="{!! request()->query('row_id',0) !!}">
    <div class="row">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">{{trans('app.English Name')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" id="name_en" name="name_en" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">{{trans('app.Arabic Name')}}</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" id="name_ar" name="name_ar" required/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Col-->
    </div>
@endsection

@section('content')
    @parent
    {{-- Put here any extra html content --}}
@endsection

@section('js')
    <script>
        let row_id = {!! request()->query('row_id',0) !!};
    </script>
    @parent
    {{-- Put here any extra js content using <script></script> --}}
@endsection
