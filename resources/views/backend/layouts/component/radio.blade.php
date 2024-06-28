<div class="col-12">
    <!--begin::Option-->
    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex  text-start p-6 mb-5 {{$active}}" data-kt-button="true">
        <!--begin::Radio-->
        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
            <input class="form-check-input" type="radio" name="{{$name}}" value="{{$value}}" {{ $checked}}/>
        </span>
        <!--end::Radio-->
        <!--begin::Info-->
        <span class="ms-5">
            <span class="fs-4 fw-bold text-gray-800 d-block">{{$title}}</span>
        </span>
        <!--end::Info-->
    </label>
    <!--end::Option-->
</div>