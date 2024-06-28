var lang = document.currentScript.getAttribute("lang"); //1

var datatable_trans = "https://cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
var add_trans = "Add";
var edit_trans = "Edit";
var select_an_option_trans = "Select an Option";
var Invalid_data = "Invalid data";

if (lang == "ar") {
    datatable_trans = "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json";
    add_trans = "اضافة";
    edit_trans = "تعديل";
    select_an_option_trans = "حدد اختيار";
    Invalid_data = "بيانات غير صالحة";

} else {
    if (typeof CKEDITOR !== "undefined")
        CKEDITOR.config.language = "en";
}

function Main(tablename) {
    var target = document.querySelector("#kt_block_ui_1_target");
    var blockUI = new KTBlockUI(target);
    // jQuery.validator.setDefaults({
    //     // This will ignore all hidden elements alongside `contenteditable` elements
    //     // that have no `name` attribute
    //     ignore: ":hidden, [contenteditable='true']:not([name])"
    // });

    obj = {};
    obj.actions = function (id, reset_id) {
        $(id).attr('action', tablename + '/store');
        $("[name='_method']", $(id)).val('POST');
        $(reset_id).trigger("click");
        $(id + " select").val("").trigger("change");
        $("#exampleModalLabel").text(add_trans);
        try {
            KTCkeditor.refreshAdd()
            KTSummernote.refreshAdd();
        } catch {

        }
        try {
            GCSelect2.refresh()
        } catch {

        }
        try {
            GCSelect2.multipeRefresh()
        } catch {

        }


    };

    obj.fill_data = function (data, form_id) {
        $.each(data, function (i, item) {
            if (Array.isArray(item)) {
                $(form_id + " [name='" + i + "[]'][type!='file'][type!='checkbox'][type!='radio'][type!='hidden']").val(item).trigger('change');
            } else {
                $(form_id + " [name='" + i + "'][type!='file'][type!='checkbox'][type!='radio']").val(item);
            }
            // $(form_id + " [name='" + i + "'][type!='file']").val(item);
        });

    };


    obj.fill_portlet = function (id, form_id = "#form_add__1", reset_id = "#form_reset__1", modal_button = "#modal_button__1", custom_before, custom_after) {
        blockUI.block(form_id);
        obj.actions(form_id, reset_id);
        $(modal_button).trigger("click");
        $(form_id).attr('action', tablename + "/update/" + id);
        $("[name='_method']", $(form_id)).val('PUT');
        $("#exampleModalLabel").text(edit_trans);

        $.ajax('/' + tablename + "/show/" + id, {
            complete: function (jqXHR, textStatus) {
                try {

                    var data = $.parseJSON(jqXHR.responseText);

                } catch {
                    data = jqXHR.responseText;
                }
                if (typeof custom_before !== "undefined")
                    custom_before(data);

                try {

                    obj.fill_data(data, form_id)

                } catch {

                }
                try {
                    KTCkeditor.refreshEdit()
                    KTSummernote.refreshEdit();
                } catch {

                }
                try {
                    GCSelect2.refresh()
                } catch {

                }

                try {
                    GCSelect2.multipeRefresh()
                } catch {

                }
                if (typeof custom_after !== "undefined")
                    custom_after(data);

                blockUI.release(form_id);
            }
        });
    };

    obj.delete_item = function (id, table_id = "#kt_table_1", form_id = "#delete_form", status = null, afterdelete) {


        var descQuestion = "";
        var descResponse = "";
        var titleResponse = "";
        var classButton = "";
        var iconButton = "";
        if (status == "delete") {
            descQuestion = Lang.get('app.You will Delete this row!');
            descResponse = Lang.get('app.This row deleted successfully');
            titleResponse = Lang.get('app.Deleted');
            classButton = "danger";
            iconButton = "la-trash-o";
        } else if (status == "approve") {
            descQuestion = Lang.get('app.You will Active this row!');
            descResponse = Lang.get('app.This row Activated successfully');
            titleResponse = Lang.get('app.Activated');
            classButton = "success";
            iconButton = "la-check-circle";
        } else if (status == "suspend") {
            descQuestion = Lang.get('app.You will Suspend this row!');
            descResponse = Lang.get('app.This row Suspended successfully!');
            titleResponse = Lang.get('app.Suspended');
            classButton = "warning";
            iconButton = "la-ban";
        }
        swal.fire({
            title: Lang.get('app.Are You Sure?'),
            text: descQuestion,
            icon: "warning",

            confirmButtonText: `<span><i class='la ${iconButton}'></i><span>${Lang.get('app.Confirm')}</span></span>`,
            showCancelButton: true,
            cancelButtonText: `<span><i class='la la-remove'></i><span>${Lang.get('app.No, thanks')}</span></span>`,
            customClass: {
                confirmButton: "btn btn-" + classButton + " m-btn m-btn--pill m-btn--air m-btn--icon",
                cancelButton: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
            }
        }).then(function (result) {
            let method = ""
            if (status === "delete") {
                method = "destroy"
            } else if (status === "approve" || status === "suspend") {
                method = "status"
            } else {
                swal.fire(
                    Lang.get('app.Invalid Status'),
                    Lang.get('app.Please contact with support!'),
                    'error'
                )
                return false;
            }
            if (result.value) {
                $.ajax({
                    url: tablename + '/' + method + '/' + id,
                    type: 'delete',
                    data: {
                        'status': status === "reject" ? 'suspend' : status,
                        '_method': 'delete'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function (arr, $form, options) {
                        blockUI.block({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'primary',
                            message: 'Processing...'
                        });
                    },
                    success: function (e) {
                        try {
                            afterdelete(e);
                        } catch {
                        }
                        swal.fire(titleResponse, descResponse, "success");
                    },
                    error: function (e) {

                        try {
                            error = $.parseJSON(e.responseText);
                        } catch {
                            error = e.responseText;
                        }
                        var errors = "";
                        try {
                            if (error.message) {
                                $.each(error.message, function (index, value) {
                                    errors += value + "<br>";
                                });
                            } else {
                                $.each(error, function (index, value) {
                                    errors += value + "<br>";
                                });
                            }
                            toastr.error(errors, Invalid_data + "!");
                        } catch (err) {
                            toastr.error(e.statusText, Invalid_data + "!");
                        }
                    },
                    complete: function (e) {
                        $(table_id).DataTable().ajax.reload(null, false);
                        blockUI.release();
                    }
                });
            } else if (result.dismiss === 'cancel') {
                $(table_id).DataTable().ajax.reload(null, false);
                swal.fire(
                    Lang.get('app.Cancelled'),
                    Lang.get('app.Request canceled successfully'),
                    'error'
                )
            }
        });
    };

    obj.delete_rows = function (table_id = "#kt_table_1", values = [], status = "delete_rows", afterdelete) {
        let text = Lang.get('app.These rows will be deleted!');
        let successTitle = Lang.get('app.Deleted');
        let successMsg = Lang.get('app.These rows deleted successfully');

        if (status === 'approve_rows') {
            text = Lang.get('app.These rows will be approved.');
            successTitle = Lang.get('app.Approved');
            successMsg = Lang.get('app.These rows approved successfully');

        } else if (status === 'suspend_rows') {
            text = Lang.get('app.These rows will be suspended.');
            successTitle = Lang.get('app.Suspended');
            successMsg = Lang.get('app.These rows suspended successfully');
        }

        if (values.length > 0) {
            let method = ""
            if (status === "delete_rows") {
                method = "destroyBulk"
            } else if (status === "approve_rows" || status === "suspend_rows") {
                method = "statusBulk"
            } else {
                swal.fire(
                    Lang.get('app.Invalid Status'),
                    Lang.get('app.Please contact with support!'),
                    'error'
                )
                return false;
            }
            swal.fire({
                title: Lang.get('app.Are You Sure?'),
                text: text,
                icon: "warning",

                confirmButtonText: `<span><i class='la la-trash-o'></i><span>${Lang.get('app.Confirm')}</span></span>`,
                confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",

                showCancelButton: true,
                cancelButtonText: `<span><i class='la la-remove'></i><span>${Lang.get('app.Cancel')}</span></span>`,
                cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: tablename + '/' + method,
                        type: 'post',
                        data: {'status': status, "values": values},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSubmit: function (arr, $form, options) {
                            blockUI.block({
                                overlayColor: '#000000',
                                type: 'v2',
                                state: 'primary',
                                message: 'Processing...'
                            });
                        },
                        success: function (e) {
                            try {
                                afterdelete(e);
                            } catch {
                            }
                            try {
                                $(table_id).DataTable().ajax.reload(null, false);
                            } catch {
                            }
                            if (e.data !== undefined && e.data.print_message) {
                                successMsg = e.message;
                            }
                            swal.fire(
                                successTitle,
                                successMsg,
                                "success"
                            );
                            blockUI.release();
                            $('#count_rows').text(0);
                            $('.count_rows').text(0);
                        },
                        error: function (e) {

                            // error = $.parseJSON(e.responseText);
                            try {
                                error = $.parseJSON(e.responseText);
                            } catch {
                                error = e.responseText;
                            }


                            var errors = "";
                            try {
                                if (error.message) {
                                    $.each(error.message, function (index, value) {
                                        errors += value + "<br>";
                                    });
                                } else {
                                    $.each(error, function (index, value) {
                                        errors += value + "<br>";
                                    });
                                }
                                toastr.error(errors, Lang.get('app.Invalid data') + "!");
                            } catch (err) {
                                toastr.error(err, Lang.get('app.Invalid data') + "!");
                            }
                            blockUI.release();
                        }
                    });
                    // result.dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal.fire(
                        Lang.get('app.Cancelled'),
                        Lang.get('app.Your request canceled successfully'),
                        'error'
                    )
                }
            });
        } else {
            swal.fire(Lang.get('app.Sorry!'), Lang.get('app.You did not select any row'), "question");
        }
    };

    obj.validation = function (form = 'form_add__1', table_id = "#kt_table_1", modal_id, rulz = {}, afterSubmit) {

        if ($('#' + form).length) {
            // element exists
            var validator = FormValidation.formValidation(
                document.getElementById(form),
                {
                    fields: rulz,
                    plugins: {
                        excluded: new FormValidation.plugins.Excluded(),
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    },
                }
            );

            // Submit button handler
            const submitButton = document.getElementById('btn_submit_1');
            submitButton.addEventListener('click', function (e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        // console.log('validated!');
                        // console.log(form.getAttribute('action'))

                        if (status == 'Valid') {

                            $.ajax({
                                url: '/' + $('#' + form).attr('action'),
                                type: 'POST',
                                data: new FormData(document.querySelector('#' + form)),
                                processData: false,
                                contentType: false,
                                headers: {
                                    'Accept': "application/json"
                                },
                                beforeSend: function (xhr) {
                                    blockUI.block();

                                    // Disable button to avoid multiple click
                                    submitButton.disabled = true;
                                },
                                success: function (data) {
                                    toastr.success(Lang.get("app.Request completed successfully!"));
                                    $('#modal_close_1').trigger('click');

                                    if(data?.data?.redirect !== undefined)
                                    window.location.href = data.data.redirect;
                                },
                                error: function (error) {
                                    const errors = error.responseJSON.errors;
                                    let errorText = '';

                                    if (Object.keys(errors).length) {
                                        $.each(errors, function (key, value) {
                                            errorText += value + '<br>';
                                        });
                                    } else {
                                        errorText = error.responseJSON.message;
                                    }

                                    toastr.error(errorText, Lang.get("app.Request Failed."));
                                },
                                complete: function () {
                                    $(table_id).DataTable().ajax.reload(null, false);
                                    blockUI.release();

                                    // Disable button to avoid multiple click
                                    submitButton.disabled = false;
                                }
                            });
                        }
                    });
                }
            });
        }
    }

    return obj;

}

function LoopPages(Permissions, $row_id, params = []) {
    var Pages = ``;
    var param = ``;
    $.each(Permissions, function (index, value) {
        if (index != tablename) {
            $.each(params[index], function (ind, val) {
                param += `&${ind}=${val}`
            })

            if (value.preview == 1) {
                var name = value.name_en;
                if (lang == "ar") {
                    name = value.name_ar;
                }

                Pages += `<a href="/${index}&row_id=${$row_id}${param}" target="_blank" class="dropdown-item">
                              <i class="la la-angle-double-down"></i> ${name}
                          </a>`;
            }
        }
    });
    return Pages;
}

function Dropdown(name, link) {
    if (link)
        return `<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ${name}
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                      </button>
                      <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                        ${link}
                      </ul>
                </div>`
    return "";
}

function DropdownBlock(name, link) {
    if (link)
        return `<span class="dropdown btn-block" >
                <button href="#" class="btn btn-secondary btn-sm btn-block" data-toggle="dropdown" aria-expanded="true">
                  ${name} <i class="la la-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="z-index: 999">
                    ${link}
                </div>
            </span>`
    return "";
}


function select(link, select_id, onSuccess = function () {

}) {
    if (link) {
        return {
            init: function () {
                $.ajax(link, {
                    complete: function (jqXHR, textAdministration) {
                        var data = $.parseJSON(jqXHR.responseText);
                        $("#" + select_id).html(``)
                        data.forEach(function (value, i) {
                            if ((i == 0) && ($('#Select option[value="0"]').length == 0)) {
                                $("#" + select_id).append(`<option value=''>${select_an_option_trans}</option>`);
                            }
                            $("#" + select_id).append("<option value='" + value.id + "'>" + value.title + "</option>")

                        });
                        onSuccess();

                    }
                });
            }
        }
    }
}

function multiple_select(link, select_id) {
    if (link) {
        return {
            init: function () {
                $.ajax(link, {
                    complete: function (jqXHR, textAdministration) {
                        var data = $.parseJSON(jqXHR.responseText);
                        $("#" + select_id).html("")
                        data.forEach(function (value, i) {
                            $("#" + select_id).append("<option value='" + value.id + "'>" + value.name + "</option>")
                        });
                    }
                });
            }
        }
    }
}

function multiple_select_group(link, select_id) {
    if (link) {
        return {
            init: function () {
                $.ajax(link, {
                    complete: function (jqXHR, textAdministration) {
                        var data = $.parseJSON(jqXHR.responseText);
                        $("#" + select_id).html("")
                        data.forEach(function (value, i) {
                            text = ``;
                            if (value.categories_count > 0) {
                                categories = value.categories;
                                text += `<optgroup label="${value.name}">`;
                                categories.forEach(function (val, ind) {
                                    text += `<option value="${val.id}">${val.name}</option>`;
                                });
                                text += `</optgroup>`;
                            }
                            // else{
                            //     text += `<optgroup label="Others">`;
                            //     // categories.forEach(function (val, ind) {
                            //         text += `<option value="${value.id}">${value.name}</option>`;
                            //     // });
                            //     text += `</optgroup>`;
                            // }
                            $("#" + select_id).append(text)
                        });
                    }
                });
            }
        }
    }
}


var editors = {}; // You can also use new Map() if you use ES6.

var KTSummernote = {
    // public functions
    init: function () {
        $('.summernote').summernote({
            height: 150
        });
    },
    refreshAdd: function () {
        $('.summernote').each(function () {
            $('#' + this.id).summernote('code', "")
        });
    },
    refreshEdit: function () {
        $('.summernote').each(function () {
            $('#' + this.id).summernote('code', $(`#${this.id}`).val());
        });
    }

};

var KTFormRepeater = {
    // public functions
    init: function () {
        $('.FormRepeaterContainer').repeater({
            initEmpty: false,

            defaultValues: {
                //
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    },
    refreshAdd: function () {
        var item = $('.FormRepeaterContainer div[data-repeater-item]');
        if (item.length > 1) {
            $.each(item, function (key, value) {
                if (key != 0) {
                    value.remove()
                }
            })
        }
    },
    refreshEdit: function (pages, containerName, btnContainerName) {
        $.each(pages, function (key, value) {
            if (key !== 0) {
                $('#' + btnContainerName).click();
            }

            // $('[name="relatedPageContainer[' + key + '][btn_color]"]').val(value.btn_color)
            // $('[name="relatedPageContainer[' + key + '][type]"]').val(value.type)
            // $('[name="relatedPageContainer[' + key + '][into_btn_action]"]').val(value.into_btn_action)

            $.each(value, function (i, item) {
                $('[name="' + containerName + '[' + key + '][' + i + ']"][type!="file"][type!="checkbox"][type!="radio"]').val(item)
                // if (isArray(item)) {
                //     $(form_id + " [name='" + i + "[]'][type!='file'][type!='checkbox'][type!='radio'][type!='hidden']").val(item).trigger('change');
                // } else {
                //     $(form_id + " [name='" + i + "'][type!='file'][type!='checkbox'][type!='radio']").val(item);
                // }
                // $(form_id + " [name='" + i + "'][type!='file']").val(item);
            });
        })


    }

};

var KTCkeditor = {
    init: function (dataOutside) {
        $('.crud-ckeditor').each(function () {


            var id = this.id;
            ClassicEditor
                .create(document.querySelector(`#${id}`), {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                        ]
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                    placeholder: 'Type article here!',
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 20, 22],
                        supportAllValues: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },

                    ckfinder: {
                        // Use named route for CKFinder connector entry point
                        uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json'
                    }
                })
                .then(editor => {

                    editors[id] = editor;
                    editors[id].model.document.on('change:data', (evt, data, options) => {
                        $(`#${id}`).val(editors[id].getData())
                        try {

                            dataOutside(id)

                        } catch {

                        }
                        $(`#${id}`).trigger("change")
                    });

                })
                .catch(e => {
                    console.error(e)
                });

        });


    },
    refreshAdd: function () {

        $('.crud-ckeditor').each(function () {
            editors[this.id].setData("")
        });
    },
    refreshEdit: function () {
        $('.crud-ckeditor').each(function () {
            editors[this.id].setData($(`#${this.id}`).val());
        });
    },
    Readonly: function () {
        $('.crud-ckeditor').each(function () {
            editors[this.id].isReadOnly = true;
        });
    },
    UnReadonly: function () {
        $('.crud-ckeditor').each(function () {
            editors[this.id].isReadOnly = false;
        });
    }
}

var GCSelect2 = {
    init: function () {
        $('.auto-select-2').each(function () {
            var id = this.id;
            $("#" + id).select2({
                placeholder: Lang.get('app.Select an Option'),
                width: '100%'
            })
        });
    },
    refresh: function () {
        $('.auto-select-2').each(function () {
            var id = this.id;
            $("#" + id).trigger("change")
        });
    },
    multipeRefresh: function (data) {
        $('.auto-select-2-multiple').each(function () {
            var id = this.id;

            $.each(data[id], function (i, e) {

                $("#" + id + " option[value='" + e + "']").prop("selected", true);

            });
        });

    },
    Readonly: function (data) {
        $('.disable-select-2').each(function () {
            var id = this.id;


            $("#" + id).prop("disabled", true);

        });

    },
    UnReadonly: function (data) {
        $('.disable-select-2').each(function () {
            var id = this.id;
            $("#" + id).prop("disabled", false);

        });

    },
}

/**
 * Use this function with any form button to submit with Ajax.
 * @param e
 * @param datatableId table to reload after success
 */
function submitFormWithAjax(e, datatableId = null) {
    e.preventDefault();
    let btn = e.target;

    var formElement;
    if (btn.hasAttribute("form")) {
        formElement = document.getElementById(btn.getAttribute("form"));
    } else {
        formElement = $(btn).parents('form')[0];
    }
    let modalDiv = $(btn).parents('div.modal')[0];

    $(formElement).ajaxSubmit({
        headers: {
            "Accept": "application/json"
        },
        beforeSubmit: function (arr, $form, options) {
            blockUI.block({
                overlayColor: '#000000',
                type: 'v2',
                state: 'primary',
                message: 'Processing...'
            });
        },
        success: function (e) {
            blockUI.release();
            toastr.success("Success");

            if (datatableId !== null)
                $('#' + datatableId).DataTable().ajax.reload(null, false);

            $(modalDiv).modal('hide');
        },
        error: function (e) {
            try {
                // error = $.parseJSON(e.responseText);
                error = e.responseJSON.errors ?? e.responseJSON;
            } catch {
                error = e.responseText;
            }
            var errors = "";
            try {
                if (error.message) {
                    msg = error.message
                    if (Array.isArray(msg) === true) {
                        $.each(error.message, function (index, value) {
                            errors += value + "<br>";
                        });
                    } else {
                        errors = error.message;
                    }
                } else {
                    $.each(error, function (index, value) {
                        errors += value + "<br>";
                    });
                }
                toastr.error(errors, Invalid_data + "!");


            } catch (err) {

                toastr.error(err, Invalid_data + "!");
            }
            blockUI.release();
        }
    });
}

/**
 * For Bulk Deleting
 */
$("#button_delete_rows").click(function () {
    var values = $(".kt-checkable:checked[name='id[]']").map(function () {
        return $(this).val();
    }).get();
    table__1.delete_rows("#kt_table_1", values, 'delete_rows');
});

/**
 * For Bulk Approve
 */
$("#button_approve_rows").click(function () {
    var values = $(".kt-checkable:checked[name='id[]']").map(function () {
        return $(this).val();
    }).get();
    table__1.delete_rows("#kt_table_1", values, 'approve_rows');
});

/**
 * For Bulk Suspend
 */

$("#button_suspend_rows").click(function () {
    var values = $(".kt-checkable:checked[name='id[]']").map(function () {
        return $(this).val();
    }).get();
    table__1.delete_rows("#kt_table_1", values, 'suspend_rows');
});

var tablename = document.currentScript.getAttribute("tablename");

var table__1 = Main(tablename);
table__1.validation((form = 'form_add__1'), (ReloadTable = "#kt_table_1"), "#kt_modal_1");

$("#modal_button__1").click(function () {
    // To Remove the error message from the email input
    $('#email-error').remove();
    $('input[type="email"]').removeClass('is-invalid');

    table__1.actions("#form_add__1", "#form_reset__1");
});

// Defining columns and columnsDefs
var columns = datatableColumnNames;
var columnsDefs = [
    {
        targets: 0,
        render: function (data, type, full, meta) {
            return `<label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input type="checkbox" name="id[]" value="${full.id}" class="form-check-input kt-checkable">
                    </label>`;
        },
    }
];

var dom_datatables = `<'card'
                            <'card-header border-0 pt-6'
                                <'card-title'
                                    <'d-flex align-items-center position-relative my-1'
                                        f
                                    >
                                >
                                <'card-toolbar'
                                    <'d-flex justify-content-end'
                                        B
                                    >
                                >
                            >
                            <'card-body pt-0'
                                <'dataTables_wrapper dt-bootstrap4 no-footer'
                                    <''
                                        tr
                                    >
                                >
                                <'row'
                                    <'col-md-3 d-flex align-items-center justify-content-start justify-content-md-start'
                                        i
                                    >
                                    <'col-md-6 d-flex align-items-center justify-content-center'
                                        p
                                    >
                                    <'col-md-3 d-flex justify-content-end'
                                        l
                                    >
                                >
                            >
                        >
                        `;
var button_datatables = [
    {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        columns: ':not(.noVis)',
        text: Lang.get('app.Column Visibility')
    },
    // {
    //     extend: 'copyHtml5',
    //     text: Lang.get('app.Copy'),
    //     exportOptions: {
    //         columns: ':visible :not(.not-exportable)'
    //     }
    // },
    {
        extend: 'csvHtml5',
        exportOptions: {
            columns: ':visible :not(.not-exportable)'
        }
    },
    {
        extend: 'excelHtml5',
        exportOptions: {
            columns: ':visible :not(.not-exportable)'
        }
    },
    {
        extend: 'pdfHtml5',
        exportOptions: {
            columns: ':visible :not(.not-exportable)'
        }
    },
    {
        extend: 'print',
        text: Lang.get('app.Print'),
        exportOptions: {
            columns: ':visible :not(.not-exportable)'
        }
    },
    {
        text: Lang.get('app.Reload'),
        action: function (e, dt, node, config) {
            dt.ajax.reload(null, false);
        }
    }
];

$('#modal_close_1,#form_reset__1').click(function () {
    $('#kt_modal_1').modal('hide');
})
$('#modal_filter_close_1,#form_filter_reset__1').click(function () {
    $('#kt_modal_filter_1').modal('hide');
})


