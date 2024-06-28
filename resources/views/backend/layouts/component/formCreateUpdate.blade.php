<div class="modal fade" id="kt_modal_1" tabindex="-1" aria-hidden="true" data-bs-focus="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content" id="kt_block_ui_1_target">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{__('app.Create')}} {!! $currentPage->{'name_'.App::getLocale()} !!}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div id="modal_close_1" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                  transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                  transform="rotate(45 7.41422 6)" fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_add__1" class="form" action="/{{$currentPage->route}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <!--begin::Row-->
                    @yield('form')
                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" id="form_reset__1" class="btn btn-light me-3">
                            {{__('app.Cancel')}}
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="btn_submit_1" class="btn btn-primary">
                            <span class="indicator-label">{{__('app.Submit')}}</span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Action buttons-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
