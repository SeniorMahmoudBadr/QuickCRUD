custom_before = function (data) {
    KTFormRepeater.refreshEdit(data.related_page,'relatedPageContainer','addRelatedPageContainer')
};

custom_after = function (data) {

};

$("#modal_button__1").click(function () {
    // To Remove the error message from the email input
    KTFormRepeater.refreshAdd()

});

$('#addon-route').click(function (){
    $('#controller,#blade,#javascript').val($('#route').val())
})

var datatableOptions = {
    ajax: {
        url: tablename+'/index',
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

// GCSelect2.init();

KTFormRepeater.init();
