@extends('layouts.pageTemplate', ['hasFilters' => false])

@section('css')
    @parent
    {{-- Put here any extra css content --}}
@endsection

@section('filters')
    <div class="mb-10">
        <label class="form-label fs-6 fw-semibold">Status:</label>
        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-Page-table-filter="status" data-hide-search="true">
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
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-8 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ trans('app.Role Name') }}</span>
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ trans('app.Specify a target name for future usage and reference') }}"></i>
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" placeholder="{{ trans('app.Enter Role Name') }}" name="name" id="name" />
    </div>

    <div class="separator my-10"></div>

    <!--begin::Permissions-->
    <div class="fv-row">
        <!--begin::Label-->
        <label class="fs-5 fw-bold form-label mb-2">{{ trans('app.Feature Permissions') }}</label>
        <!--end::Label-->
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                    <!--begin::Table row-->
                    <tr>
                        <td class="text-gray-800">{{ trans('app.Administrator Access') }}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ trans('app.Allows a full access to the system') }}"></i>
                        </td>
                        <td>
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                <span class="form-check-label" for="kt_roles_select_all">{{ trans('app.Select all') }}</span>
                            </label>
                            <!--end::Checkbox-->
                        </td>
                    </tr>
                    <!--end::Table row-->

                    @foreach ($pages->where('role_editable', 1) as $page)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Label-->
                            <td class="text-gray-800 togglePage">{{ $page->{'name_' . App::getLocale()} }}</td>
                            <!--end::Label-->
                            <!--begin::Input group-->
                            <td>
                                <!--begin::Wrapper-->
                                <div class="d-flex checkboxWrapper">
                                    @foreach ($page->permissions->where('status', 'approved') as $permission)
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input permissionInputCheck" type="checkbox" value="{{ $permission->id }}" name="permission[{{ $permission->id }}]" />
                                            <span class="form-check-label">{{ Str::replaceFirst($page->route . '-', '', $permission->name) }}</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    @endforeach
                                </div>
                                <!--end::Wrapper-->
                            </td>
                            <!--end::Input group-->
                        </tr>
                        <!--end::Table row-->
                    @endforeach

                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Permissions-->
@endsection

@section('content')
    @parent
@endsection

@section('js')
    @parent
    <script>
        // $('.rolesContainer').on('hide.bs.modal', function (e) {
        //     console.log('closed')
        //     // do something...
        //     $('.rolesContainer').show();
        // })
    </script>
@endsection
