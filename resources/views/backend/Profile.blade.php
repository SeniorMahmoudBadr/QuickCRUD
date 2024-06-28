@extends('backend.layouts.app')

@section('title', __('app.Profile'))

@section('css')
    @livewireStyles
@endsection

@section('content')
<div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Products-->
        <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{__('app.Edit Profile')}}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">

                        <livewire:backend.edit-profile />

                    </div>
                    <!--end::Content-->
                {{-- </div> --}}
                {{-- End: Main Profile Info --}}

                {{-- Change Password --}}
                <div class="card mb-5 mb-xl-10" style="display:none">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{__('app.Change Password')}}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">

                        <livewire:backend.change-password />

                    </div>
                    <!--end::Content-->
                </div>
                {{-- End Change Password --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('js')
    @livewireScripts

    <script>
        Livewire.on('profileUpdated', data => {
            // console.log(data);
            $('#user-name').text(data.name);
            $('#user-avatar').attr("src", data.avatar);
            toastr.success("{{__('app.Profile updated successfully!')}}");
        });

        Livewire.on('passwordUpdated', data => {
            toastr.success("{{__('app.Password updated successfully!')}}");
        });

    </script>
@endsection
