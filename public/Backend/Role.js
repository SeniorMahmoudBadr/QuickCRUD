custom_before = function (data) {
    $('#role_id_'+data.id).hide();
};

$('.togglePage').click(function(){
    $(this).closest('tr').find('.checkboxWrapper input[type=checkbox]').each(function() {
        this.checked = !this.checked;
    });
});

$('#kt_modal_1').on('hide.bs.modal', function (e) {
    $('.rolesContainer').show();
})

custom_after = function (data) {
    $('.permissionInputCheck').prop('checked', false);
    $.each(data.permission, function (key, value) {
        $(`.permissionInputCheck[name="permission[${value.id}]"]`).prop('checked',true);
    })
    $('.RolesInputCheck').prop('checked', false);
    $.each(data.children, function (key, value) {
        $(`.RolesInputCheck[value="${value.child_id}"]`).prop('checked',true);
    })

    var countCheckbox = $('.RolesInputCheck:visible').length
    var countCheckboxChecked = $('.RolesInputCheck:checked').length
    $('#full_authority').prop('checked', countCheckbox === countCheckboxChecked)
};

var datatableOptions = {
    ajax: {
        url: tablename + '/index',
        data: function (d) {
            name_search = function () {
                return $("#name_search").val();
            };
            d.name_search = name_search();
        },
    }
};

// Do any changes to datatable options object.
function datatableOptionsModifications(optionsObject) {
    return optionsObject;
}

function extraDatatableContent(table) {
}

$('#kt_roles_select_all').click(function () {
    var isChecked = $(this).is(':checked');
    $('.permissionInputCheck').prop('checked', isChecked)
})

$('#full_authority').click(function () {
    var isChecked = $(this).is(':checked');
    $('.RolesInputCheck:visible').prop('checked', isChecked)
})

$('.RolesInputCheck').click(function (){
    var countCheckbox = $('.RolesInputCheck:visible').length
    var countCheckboxChecked = $('.RolesInputCheck:checked').length
    $('#full_authority').prop('checked', countCheckbox === countCheckboxChecked)
})


