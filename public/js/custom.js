// encapsulate the jquery functions to works only inside this context.
function init() {
    $('#table_id').DataTable();
}


$(document).ready( function () {
    init();
} );