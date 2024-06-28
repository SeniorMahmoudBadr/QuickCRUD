@extends('backend.layouts.app')

@php
    $row_id = !empty($_GET['row_id']) ? $_GET['row_id'] : '';
@endphp

@section('title', $currentPage->name ?? $currentPage->name_en)

@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Products-->
        <div class="card card-flush mb-3">
            <div class="card-header  align-items-center gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        @yield('subpage')
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="d-flex justify-content-end" data-kt-Page-table-toolbar="base">
                        @if ($hasFilters)
                            <!--begin::Filter-->
                            @include('backend.layouts.component.filter')
                            <!--end::Filter-->
                        @endif
                        @yield('extra-buttons')
                        @include('backend.layouts.component.bulk_buttons')
                        @if (!empty($replaceCreateBtn))
                            @yield('createBtn')
                        @else
                            <!--begin::Add Page-->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" @if (!auth()->user()->can($currentPage->route . '-create')) style="display: none" @endif data-bs-target="#kt_modal_1" id="modal_button__1">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                @yield('add-button-text', __('app.New Record'))
                            </button>
                        @endif

                        @if (!empty($replaceForm))
                            @yield('form')
                        @else
                            @include('backend.layouts.component.formCreateUpdate')
                        @endif

                        <!--end::Add Page-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-Page-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-Page-table-select="selected_count"></span>Selected
                        </div>
                        <button type="button" class="btn btn-danger" data-kt-Page-table-select="delete_selected">Delete Selected
                        </button>
                    </div>
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            @if ($hasFilters)
                <div class="card-body pt-0">
                    <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body">
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt-form" action="javascript:;">

                                @yield('filters')

                                <!--begin::Separator-->
                                <div class="separator mb-6"></div>
                                <!--end::Separator-->
                                <!--begin::Action buttons-->
                                <div class="d-flex">
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_search" class="btn btn-dark me-3 w-100px">
                                        {{ trans('app.Search') }}
                                    </button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="button" id="kt_reset" class="btn btn-secondary w-100px">
                                        {{ trans('app.Reset') }}
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Action buttons-->
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <!--end::Card-->
            @yield('anotherForm')
        </div>
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_1"></table>
        <!--end::Table-->
    </div>
    <!-- end:: Content -->
@endsection

@section('js')

    <script>
        let datatableColumnNames = @json($datatableColumnNames);
    </script>
    <!--begin::Page Vendors(used by this page) -->
    <script type="text/javascript" src="{{ asset('Backend/main.js') }}" lang="{{ App::getLocale() }}" tablename="{{ \App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX . '/' . $currentPage->route }}"></script>
    <script type="text/javascript" src="{{ asset('Backend/' . $currentPage->javascript . '.js') }}" row_id="{{ $row_id }}"></script>
    <script type="text/javascript" src="{{ asset('Backend/exec_datatable.js') }}"></script>
    <!--end::Page Vendors -->
@endsection
