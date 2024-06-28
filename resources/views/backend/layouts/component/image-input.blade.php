{{--
$currentValue
$inputName
$inputAccept
$required
--}}

<!--begin::Image input-->
<div id="image-input-el" class="image-input image-input-empty" data-kt-image-input="true">
    <!--begin::Image preview wrapper-->
    <div id="image-input-wrapper-id" class="image-input-wrapper w-125px h-125px"
         @if(isset($currentValue))
             style="background-image: url({{ asset($currentValue) }})"
         @else
             style='background-image: url("{{asset('/assets/media/placeholder-image.jpg')}}")'
        @endif
    ></div>
    <!--end::Image preview wrapper-->

    <!--begin::Edit button-->
    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="change"
           data-bs-toggle="tooltip"
           data-bs-dismiss="click"
           title="Change avatar">
        <i class="bi bi-pen"></i>

        <!--begin::Inputs-->
        <input type="file"
               id="{{ $inputName ?? 'image' }}"
               name="{{ $inputName ?? 'image' }}"
               accept="{{ $inputAccept ?? '.png, .jpg, .jpeg, .webp, .svg' }}"
            @required(!empty($required))
        />
        <input type="hidden" name="avatar_remove" />
        <!--end::Inputs-->
    </label>
    <!--end::Edit button-->

    <!--begin::Cancel button-->
    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
          data-kt-image-input-action="cancel"
          data-bs-toggle="tooltip"
          data-bs-dismiss="click"
          title="Cancel avatar">
        <i class="bi bi-x"></i>
    </span>
    <!--end::Cancel button-->

    <!--begin::Remove button-->
    {{--<span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
          data-kt-image-input-action="remove"
          data-bs-toggle="tooltip"
          data-bs-dismiss="click"
          title="Remove avatar">
        <i class="bi bi-x"></i>
    </span>--}}
    <!--end::Remove button-->
</div>
<!--end::Image input-->
