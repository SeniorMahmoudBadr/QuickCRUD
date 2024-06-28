@php
    $pages = getCachedPages()->whereNull('childPage')->where('position','left')->where('display','show')->sortBy('sort');
@endphp


<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
     style="top: 60px !important">
    <!--begin::Sidebar wrapper-->
    <div id="kt_app_sidebar_wrapper" class="flex-grow-1 hover-scroll-y mt-9 mb-5 px-2 mx-3 ms-lg-7 me-lg-5"
         data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-offset="5px">
        <!--begin::Main menu-->
        <div
            class="menu-sidebar menu menu-fit menu-column menu-rounded menu-title-gray-700 menu-icon-gray-700 menu-arrow-gray-700 fw-semibold fs-6 align-items-stretch flex-grow-1"
            id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="true">
            <!--begin:Menu item-->

            <!--end:Menu item-->
            @foreach($pages as $page)

                @if($page->relatedPage->where('type','modal')->count() > 0)
                    @php
                        $visiblePage= false;
                        $hoverDropDown='';
                        $showDropDown='';
                    @endphp
                    @foreach($page->relatedPage->where('type','modal') as $childPage)
                        @php $child = getCachedPages()->whereNotNull('childPage')->where('position','left')->where('display','show')->sortBy('sort')->where('id',$childPage->child_id)->first() @endphp
                        @can($child->route.'-list')
                            @if(Request::fullUrlIs(url(\App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX.'/'.$child->route.'/index')))
                                @php $hoverDropDown='hover'; @endphp
                                @php $showDropDown='show'; @endphp
                            @endif
                            @php $visiblePage= true; @endphp
                        @endcan
                    @endforeach
                    @if($visiblePage)
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click"
                             class="menu-item menu-accordion {{$hoverDropDown}} {{$showDropDown}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-title">{!! $page->{'name_'.App::getLocale()} !!}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div
                                class="menu-sub menu-sub-accordion menu-state-gray-900 menu-fit open {{$showDropDown}}">

                                @if($showDropDown != "show")
                                    style="display: none; overflow: hidden;"
                                @endif>
                                @foreach($page->relatedPage->where('type','modal') as $childPage)

                                    @php $child = getCachedPages()->whereNotNull('childPage')->where('position','left')->where('display','show')->sortBy('sort')->where('id',$childPage->child_id)->first() @endphp

                                    @can($child->route.'-list')
                                        <!--begin:Menu item-->
                                        <div class="menu-item menu-accordion menu-fit">
                                            <!--begin:Menu link-->
                                            <a class="menu-link @if(\Request::fullUrlIs(url(\App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX.'/'.$child->route.'/index'))) active @endif"
                                               href="/{{\App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX}}/{{$child->route}}/index">
                            <span class="menu-icon">
                                <i class="ki-outline ki-element-11 fs-4 text-gray-700"></i>
                            </span>
                                                <span
                                                    class="menu-title">{!! $child->{'name_'.App::getLocale()} !!}</span>
                                                <span class="menu-badge">
                                <button class="btn btn-sm btn-icon btn-action" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_new_target">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </button>
                            </span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        @php $visiblePage= true; @endphp
                                    @endcan
                                @endforeach

                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->

                        <div class="menu-item py-1">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <div class="separator separator-dashed"></div>
                            </div>
                            <!--end:Menu content-->
                        </div>

                    @endif
                @else
                    @can($page->route.'-list')

                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(\Request::fullUrlIs(url(\App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX.'/'.$page->route.'/index'))) active @endif"
                               href="/{{\App\Providers\RouteServiceProvider::ADMIN_PANEL_PREFIX}}/{{$page->route}}/index">
                        <span class="menu-icon">
                            <i class="ki-outline ki-element-11 fs-4 text-primary"></i>
                        </span>
                                <span class="menu-title">{!! $page->{'name_'.App::getLocale()} !!}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endcan
                @endif
            @endforeach
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Sidebar wrapper-->
</div>
