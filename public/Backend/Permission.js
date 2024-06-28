custom_before = function (data) {

};

custom_after = function (data) {

};

var datatableOptions = {
    ajax: {
        url: tablename + '/index',
        data: function (d) {
            status_search = function () {
                return $("#status_search").val();
            };
            d.status_search = status_search();
            if (row_id)
                d.row_id = row_id;
        },
    }
};

// Do any changes to datatable options object.
function datatableOptionsModifications(optionsObject) {
    return optionsObject;
}

function extraDatatableContent(table) {
}
