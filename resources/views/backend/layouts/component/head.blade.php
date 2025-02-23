<head>
    <base href="../../"/>
    <title> {{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content="Quick Crud"/>
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="{!! asset('assets/media/logos/favicon.ico') !!}"/>

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->

    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    @yield('css')
    <!--end::Page Vendor Stylesheets-->
</head>
