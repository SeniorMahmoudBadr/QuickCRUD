<div class="d-flex">
    <!--begin::Logo-->
    <div class="app-header-logo d-flex flex-center gap-2 me-lg-15">
        <!--begin::Sidebar toggle-->
        <button class="btn btn-icon btn-sm btn-custom d-flex d-lg-none ms-n2" id="kt_app_header_menu_toggle">
            <i class="ki-outline ki-abstract-14 fs-2"></i>
        </button>
        <!--end::Sidebar toggle-->
        <!--begin::Logo image-->
        <a class="text-white fw-bolder fs-2x" href="{{route('home')}}">
{{--            <img alt="Logo" src="{!! asset('logo.png') !!}" class="mh-60px">--}}
            Quick CRUD
        </a>
        <!--end::Logo image-->
    </div>
    <!--end::Logo-->
    <!--begin::Menu wrapper-->
    <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
             data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
             data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
             data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
             data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
             data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}" style="">
            <!--begin::Menu-->
            <div
                class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-gray-900 menu-icon-gray-500 menu-arrow-gray-500 menu-state-icon-primary menu-state-bullet-primary fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
                id="#kt_app_header_menu" data-kt-menu="true">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                     data-kt-menu-placement="bottom-start"
                     class="menu-item @if(Request::routeIs('home')) here show @endif menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                    <!--begin:Menu link-->
                    <a href="{{route('home')}}" class="menu-link">
                        <span class="menu-title">{!! __('app.Home') !!}</span>
                        <span class="menu-arrow d-lg-none"></span>
                    </a>
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Menu wrapper-->
</div>

<div class="app-navbar flex-shrink-0 gap-2">
    <!--begin::User menu-->
    @include('backend.layouts.component.user-menu')
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none me-n3" title="Show header menu">
        <button class="btn btn-sm btn-icon btn-custom h-35px w-35px" id="kt_app_sidebar_mobile_toggle">
            <i class="ki-outline ki-setting-3 fs-2"></i>
        </button>
    </div>
    <!--end::Header menu toggle-->
</div>
