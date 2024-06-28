custom_before = function (data) {
    $('label[for="password"], label[for="password_confirmation"]').children('span').removeClass('required');
};

custom_after = function (data) {
};

$("#modal_button__1").click(function () {
    $(".kt-avatar__holder").css(
        "backgroundImage",
        "url(/assets/media/blog/images.png)"
    );
    table__1.actions("#form_add__1", "#form_reset__1");

    $('label[for="password"], label[for="password_confirmation"]').children('span').addClass('required');
});

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

columnsDefs.push({
    targets: 2,
    render: function (data) {
        return Boolean(data) ? data : "---";
    },
});

