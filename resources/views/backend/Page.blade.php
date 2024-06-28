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

@section('titleContainer')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('subpage')
    {!! $currentPage->{'name_'.app()->getLocale()} !!}
@endsection

@section('form')
    <div class="row row-cols-1 row-cols-sm-1 rol-cols-md-1 row-cols-lg-1">
        <div class="col">
            <div class="fv-row mb-7">
                <!--begin::Input group-->
                <div class="d-flex flex-stack w-lg-75">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-semibold form-label">You need Create
                            Files?</label>
                        <div class="fs-7 fw-semibold text-muted">If Checkbox has on,
                            System
                            will be generate some files as <br> ( Model & Controller &
                            Blade
                            and JS )
                        </div>
                    </div>
                    <!--end::Label-->

                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input h-25px w-50px" type="checkbox" value="1"
                               checked="checked" id="create_files" name="create_files"/>
                        <span class="form-check-label fw-semibold text-muted">
                            Create Files
                        </span>
                    </label>
                    <!--end::Switch-->
                </div>
                <!--end::Input group-->
            </div>
        </div>
{{--        <div class="col">--}}
{{--            <div class="mb-7 fv-row">--}}
{{--                <!--begin::Wrapper-->--}}
{{--                <div class="d-flex flex-stack w-lg-75">--}}
{{--                    <!--begin::Label-->--}}
{{--                    <div class="fw-semibold me-5">--}}
{{--                        <label class="fs-6">Is route?</label>--}}
{{--                        <div class="fs-7 text-muted">Do you make it route?</div>--}}
{{--                    </div>--}}
{{--                    <!--end::Label-->--}}
{{--                    <!--begin::Checkboxes-->--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <!--begin::Checkbox-->--}}
{{--                        <label class="form-check form-switch form-check-custom form-check-solid">--}}
{{--                            <input class="form-check-input h-30px w-50px" type="checkbox" name="is_route" id="is_route"--}}
{{--                                   value="1">--}}
{{--                            <span class="form-check-label fw-semibold text-muted">Is route</span>--}}
{{--                        </label>--}}
{{--                        <!--end::Checkbox-->--}}
{{--                    </div>--}}
{{--                    <!--end::Checkboxes-->--}}
{{--                </div>--}}
{{--                <!--end::Wrapper-->--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">English Name</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control" id="name_en" name="name_en"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span>Arabic Name</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control" id="name_ar" name="name_ar"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-4 rol-cols-md-1 row-cols-lg-4">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label for="route" class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">Route</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <div class="input-group mb-5">
                    <input type="text" class="form-control" aria-describedby="addon-route" id="route" name="route">
                    <span class="input-group-text" id="addon-route">
                        <i class="fas fa-envelope-open-text fs-4"></i>
                    </span>
                </div>
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
                    <span>Controller</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control" id="controller" name="controller"/>
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
                <label for="blade" class="fs-6 fw-semibold form-label mt-3">
                    <span>Blade</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control" id="blade" name="blade"/>
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
                <label for="javascript" class="fs-6 fw-semibold form-label mt-3">
                    <span>JS</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control" id="javascript" name="javascript"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Col-->
    </div>
    <div class="row row-cols-1 row-cols-sm-4 rol-cols-md-1 row-cols-lg-4">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">Related Role</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select" id="role_id" name="role_id">
                    <option value="">Select an Option</option>
                    @foreach(\App\Models\Role::get() as $role)

                    <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                    @endforeach
                </select>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">Role Editable</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select" id="role_editable" name="role_editable">
                    <option value="">Select an Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">Display</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select" id="display" name="display">
                    <option value="">Select an Option</option>
                    <option value="show">Show</option>
                    <option value="hide">Hide</option>
                </select>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label for="position" class="fs-6 fw-semibold form-label mt-3">
                    <span class="required">Position</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select" id="position" name="position">
                    <option value="">Select an Option</option>
                    <option value="left">Left bar</option>
                    <option value="top">Top bar</option>
                </select>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span>Page's sorting</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" class="form-control" id="sort" name="sort" min="1" step="1" placeholder="{{'sidebar: '.$pages->where('position', 'left')->max('sort') + 5 . ' | top-bar: '.$pages->where('position', 'top')->max('sort') + 5}}"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-1 rol-cols-md-1 row-cols-lg-1">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Repeater-->
                <div id="relatedPageContainer" class="FormRepeaterContainer">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="relatedPageContainer">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-4">
                                        <label class="form-label">Page:</label>
                                        <select class="form-select mb-2 mb-md-0"
                                                name="child_id">
                                            <option value="">Select an Option</option>
                                            @foreach($pages as $value)
                                                <option value="{{$value->id}}">{{$value->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Color Button:</label>
                                        <select class="form-select mb-2 mb-md-0" name="btn_color">
                                            <option value="">Select an Option</option>
                                            <option value="light">light</option>
                                            <option value="primary">primary</option>
                                            <option value="secondary">secondary</option>
                                            <option value="success">success</option>
                                            <option value="info">info</option>
                                            <option value="warning">warning</option>
                                            <option value="danger">danger</option>
                                            <option value="dark">dark</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Type Button:</label>
                                        <select class="form-select mb-2 mb-md-0" name="type">
                                            <option value="">Select an Option</option>
                                            <option value="route">Route</option>
                                            <option value="modal">Model</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-5">
                                    <div class="col-md-4">
                                        <label class="form-label">Into Action Button:</label>
                                        <select class="form-select mb-2 mb-md-0"
                                                name="into_btn_action">
                                            <option value="">Select an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="javascript:;" data-repeater-delete
                                           class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="la la-trash-o"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create id="addRelatedPageContainer"
                           class="btn btn-light-primary">
                            <i class="la la-plus"></i>Add
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
            </div>
            <!--end::Input group-->
        </div>
    </div>
@endsection

@section('content')
    @parent
    {{-- Put here any extra html content --}}
@endsection

@section('js')
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    @parent
@endsection
