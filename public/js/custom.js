// encapsulate the jquery functions to works only inside this context.
function init() {
    // init the datatable object.
    $('#students').DataTable({
        processing: true,
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
    if (value !== "") {
        $('#students').DataTable()
            .search(value)
            .draw();
    }
}

/**
 * Function for add button.
 */
function add_new_button() {
    $("#add_new").click(function() {
        document.getElementById("header-form").reset();
        $("#header-form").attr("action", "students/add");
        $("#form-submit-button").html("Add new");

        $("#container_add_new").toggle();
        window.scrollTo(0, 0);
    });
}

/**
 * Function to retrieve user data when clicked in edit button of the datatable.
 */
function edit_button() {
    $(document).on("click", ".edit-button", function() {
        const id = $(this).data("id");
        const url = window.location.href + "students/find";

        $.ajax({
            type: "POST",
            url: url,
            data: {
                id
            },
            success: (res) => {
                const response = JSON.parse(res);

                if (!response.error) {
                    const data = response.data[0];

                    $("#id").val(data.id);
                    $("#first_name").val(data.first_name);
                    $("#middle_name").val(data.middle_name);
                    $("#last_name").val(data.last_name);
                    $("#phone_number").val(data.phone_number);
                    $("#classrom").val(data.class);
                    $("#year_joined").val(data.year_joined);
                    $("#header-form").attr("action", "students/edit");
                    $("#form-submit-button").html("Edit student");

                    $("#container_add_new").toggle();
                    window.scrollTo(0, 0);
                }
            },
        });
    });
}

/**
 * Close form button function.
 */
function close_form() {
    $("#close-form").click(function() {
        $("#container_add_new").toggle();
    });
}

/**
 * Function to delete the students from datatable.
 */
function delete_student() {
    $(document).on("click", "#delete-button", function() {
        const id = $(this).data("id"),
            url = window.location.href + "students/delete";

        if (confirm("Are you sure you want to delete this student?")) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id,
                },
                success: (res) => {
                    if (res) {
                        alert("Student deleted");
                        window.location.href = "/";
                    } else {
                        alert("An error occour.");
                    }
                }
            });
        }
    })
}

/**
 * Inputs filters
 */
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
 * Main entry for document jquery functions and
 * initialize all the necessary functions.
 */
$(document).ready( function () {
    init();
    inputsFilters();
    add_new_button();
    edit_button();
    close_form();
    delete_student();
} );