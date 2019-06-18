// encapsulate the jquery functions to works only inside this context.
function init() {
    // init the datatable object.
    $('#students').DataTable({
        "processing": true,
        "serverSide": true,
    });
}


// name filter
function nameFilter() {
    const value = $("#first_name_filter").val();
    if (value.length > 2) {
        $('#students').DataTable()
            .search(value)
            .draw();
    } else if (value.length === 0) {
        $('#students').DataTable()
            .search(value)
            .draw();
    }
}

// date added filter
function dateAddedFilter() {
    const value = $("#date_added_filter").val();
    $('#students').DataTable()
        .search(value)
        .draw();
}

function inputsFilters() {
    /**
     * Associate the triggers functions to launch the filters.
     */
    $('input#first_name_filter').on( 'keyup click', function () {
        nameFilter();
    });

    $('input#date_added_filter').on( 'keyup click', function () {
        dateAddedFilter();
    });
}

/**
 * Main entry for document jquery function.
 */
$(document).ready( function () {
    init();
    inputsFilters();
} );