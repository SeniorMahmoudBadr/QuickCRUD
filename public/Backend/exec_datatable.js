datatableOptions["responsive"] = false;
datatableOptions["searchDelay"] = 500;
datatableOptions["processing"] = true;
datatableOptions["ordering"] = false;
datatableOptions["serverSide"] = true;
datatableOptions["columns"] = columns;
datatableOptions["columnDefs"] = columnsDefs;
datatableOptions["dom"] = dom_datatables;
datatableOptions["buttons"] = button_datatables;
datatableOptions["language"] = {"url": datatable_trans};
datatableOptions["headerCallback"] =
    function (thead, data, start, end, display) {
        // $.each(thead.getElementsByTagName('th'), function (value) {
        //     thead.getElementsByTagName('th')[value].className = `dt-head-center`;
        // })
        thead.getElementsByTagName('th')[0].innerHTML = `
            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input kt-group-checkable" type="checkbox"/>
            </div>`;
    };

let isEmptyColumn = (data) => !data.some(value => value !== "" && value !== null && value !== undefined);

datatableOptions["initComplete"] = function (settings, json) {

    var lastColIdx = this.api().columns()[0].length - 1;

    var data = this.api().column(lastColIdx).data();

    // Check if the array is non-empty and if isEmptyColumn returns true, then hide the last column
    if (data.length !== 0 && isEmptyColumn(data.toArray())) {
        this.api().column(lastColIdx).visible(false);
    }
}

datatableOptions = datatableOptionsModifications(datatableOptions);

var KTDatatablesDataSourceAjaxServer = (function () {
    var initTable1 = function () {
        var table = $("#kt_table_1").DataTable(datatableOptions);

        // Bulk checkboxes
        table.on('change', '.kt-group-checkable', function () {
            var set = $(this).closest('table').find('td:first-child .kt-checkable');
            var checked = $(this).is(':checked');
            if (checked) {
                $('.count_rows').text(set.length);
                $('#button_delete_rows,#button_approve_rows,#button_suspend_rows,#button_reassign_rows').show();
            } else {
                $('.count_rows').text(0);
                $('#button_delete_rows,#button_approve_rows,#button_suspend_rows,#button_reassign_rows').hide();
            }
            $(set).each(function () {
                if (checked) {
                    $(this).prop('checked', true);
                    // table.rows($(this).closest('tr')).select();
                } else {
                    $(this).prop('checked', false);
                    // table.rows($(this).closest('tr')).deselect();
                }
            });
        });

        table.on('change', '.kt-checkable', function () {
            var rows = $(this).closest('table').find('td:first-child .kt-checkable');
            var checked = $(this).is(':checked');
            var set = $(this).closest('table').find('td:first-child .kt-checkable:checked');
            if (rows.length !== set.length) {
                $('.kt-group-checkable').prop('checked', false);
            } else {
                $('.kt-group-checkable').prop('checked', true);
            }

            $('.count_rows').text(set.length);

            if (set.length == 0)
                $('#button_delete_rows,#button_approve_rows,#button_suspend_rows,#button_reassign_rows').hide();
            else
                $('#button_delete_rows,#button_approve_rows,#button_suspend_rows,#button_reassign_rows').show();

            if (checked) {
                $(this).prop('checked', true);
                // table.rows($(this).closest('tr')).select();
            } else {
                $(this).prop('checked', false);
                // table.rows($(this).closest('tr')).deselect();
            }
        });

        // Filters Buttons
        $("#kt_search").on("click", function (e) {
            $("#kt_table_1").DataTable().ajax.reload(null, false);
        });

        $("#kt_reset").on("click", function (e) {
            $("#kt-form select").val("").trigger("change");
            $("#kt-form input[type='!checkbox'][type='!radio']").val("");
            $("#kt-form input[type='checkbox']").prop("checked",false);
            $("#kt_table_1").DataTable().ajax.reload(null, false);
        });

        extraDatatableContent(table);
    };
    return {
        init: function () {
            initTable1();
        },
    };
})();

jQuery(document).ready(function () {
    // if (Permissions[tablename].preview == 1) {
    KTDatatablesDataSourceAjaxServer.init();
    // } else {
    //     toastr.error("You don't have Permission", "Sorry!");
    // }
});
