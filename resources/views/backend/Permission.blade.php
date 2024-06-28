@extends('layouts.pageTemplate', ['hasFilters' => true])

@section('css')
    @parent
    {{-- Put here any extra css content --}}
@endsection
@if(!empty(request()->query('row_id')))
    @php $page=\App\Models\Page::find(request()->query('row_id')); @endphp
    @if($page)
        @section('subpage')
            : {!! $page->{'name_'.App::getLocale()} !!}
        @endsection
    @endif
@endif

@section('filters')
    <div class="mb-10">
        <label for="status_search" class="form-label fs-6 fw-semibold">الحالة:</label>
        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" id="status_search"
                data-kt-Page-table-filter="status" data-hide-search="true">
            <option value="">تحديد اختيار</option>
            <option value="approved">مفعل</option>
            <option value="Suspended">معلق</option>
        </select>
    </div>
@endsection

@section('form')
    <input type="hidden" name="page_id" value="{{ request()->query('row_id') ?? "" }}">
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-8 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">Permission Name</span>
{{--            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" data-bs-html="true" title=""></i>--}}

        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid"
               placeholder="Enter a permission name"
               name="name" id="name"/>
        <div class="fs-7 fw-semibold text-danger">Must be prefix : {{$page->route}}-{example name}<br>prefer example name is [list, create, show, edit, delete, bulk delete, bulk status]</div>
    </div>
    <!--end::Input group-->
    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
        <div class="col">
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Request Method-Type</span>
                </label>
                <!--end::Label-->
                <select type="text" class="form-control form-control-solid" name="type" id="type">
                    <option value="">Select and Option</option>
                    <option value="get">GET</option>
                    <option value="post">POST</option>
                    <option value="put">PUT</option>
                    <option value="patch">PATCH</option>
                    <option value="delete">DELETE</option>
                </select>
            </div>
        </div>
        <div class="col">
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Has Param?</span>
                </label>
                <!--end::Label-->
                <select type="text" class="form-control form-control-solid" name="has_params" id="has_params">
                    <option value="">Select and Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-8 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">Method Name</span>
        </label>
        <!--end::Label-->
        <input class="form-control form-control-solid"
               placeholder="Enter a methods name" name="method" id="method"/>
        <div class="fs-7 fw-semibold text-danger">prefer example name is [index, store, show, update, destroy, destroyBulk, statusBulk]</div>
    </div>
    <!--end::Input group-->
@endsection
@section('content')
    @parent
    {{-- Put here any extra html content --}}
@endsection

@section('js')
    <script>
        let row_id = "{{request()->query('row_id') ?? 0 }}";
    </script>
    @parent
@endsection
