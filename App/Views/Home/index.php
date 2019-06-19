{% extends "base.html" %}

{% block title %}Home{% endblock %}

{% block body %}
    <div class="row">
        <h1>Students list</h1>
        <button
            class="btn btn-primary"
            type="button"
            id="add_new"
        >
            Add new
        </button>
    </div>

    <div
        class="row hide form-row"
        id="container_add_new"
    >
        <div class="col">
            <h6>Add new</h6>
        </div>
        <div class="col-12">
            <form
                method="post"
                action="students/add"
                id="header-form"
                name="header-form"
            >
                <input type="hidden" name="id" id="id" value="" />
                <input
                  placeholder="first name"
                  value=""
                  name="first_name"
                  id="first_name"
                  maxlength="255"
                />
                <input
                    placeholder="middle name"
                    value=""
                    name="middle_name"
                    id="middle_name"
                    maxlength="255"
                />
                <input
                    placeholder="last name"
                    value=""
                    name="last_name"
                    id="last_name"
                    maxlength="255"
                />
                <input
                    placeholder="email"
                    value=""
                    name="email"
                    id="email"
                    maxlength="80"
                />
                <input
                    placeholder="classroom"
                    value=""
                    name="classroom"
                    id="classrom"
                    maxlength="120"
                />
                <input
                    placeholder="guardian name"
                    value=""
                    name="guardian_name"
                    id="guardian_name"
                    maxlength="255"
                />
                <input
                    placeholder="phone number"
                    value=""
                    name="phone_number"
                    id="phone_number"
                    maxlength="20"
                />
                <input
                    placeholder="year joined"
                    value=""
                    name="year_joined"
                    id="year_joined"
                    type="date"
                />
                <button
                    type="submit"
                    id="form-submit-button"
                >
                    Add new
                </button>
                <button
                    type="button"
                    id="close-form"
                >
                    Close form
                </button>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <table
                id="students"
                class="table table-striped table-responsive"
            >
                <thead>
                    <tr>
                        <td>
                            ID
                        </td>
                        <td>
                            <label>
                                <input
                                    type="text"
                                    placeholder="First name"
                                    id="first_name_filter"
                                    value=""
                                />
                            </label>
                            First name
                        </td>
                        <td>
                            Middle name
                        </td>
                        <td>
                            Last name
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Class
                        </td>
                        <td>
                            Guardian name
                        </td>
                        <td>
                            Phone number
                        </td>
                        <td>
                            <label>
                                <input
                                    type="text"
                                    placeholder="Date added"
                                    id="date_added_filter"
                                    value=""
                                />
                            </label>
                            Date added
                        </td>
                        <td>
                            Year joined
                        </td>
                        <td>
                            Date updated
                        </td>
                        <td>

                        </td>
                    </tr>
                </thead>
                <tbody>
                    {% for student in students %}
                        <tr>
                            <td>
                                {{ student.id }}
                            </td>
                            <td>
                                {{ student.first_name }}
                            </td>
                            <td>
                                {{ student.middle_name }}
                            </td>
                            <td>
                                {{ student.last_name }}
                            </td>
                            <td>
                                {{ student.email }}
                            </td>
                            <td>
                                {{ student.class }}
                            </td>
                            <td>
                                {{ student.guardian_name }}
                            </td>
                            <td>
                                {{ student.phone_number }}
                            </td>
                            <td>
                                {{ student.date_added }}
                            </td>
                            <td>
                                {{ student.date_joined }}
                            </td>
                            <td>
                                {{ student.date_updated }}
                            </td>
                            <td>
                                <button
                                    class="btn btn-info edit-button"
                                    name="edit-button"
                                    id="edit-button-{{ student.id }}"
                                    data-id="{{ student.id }}"
                                >
                                    Edit
                                </button>
                                <button
                                    class="btn btn-danger"
                                    name="delete-button"
                                    id="delete-button"
                                    data-id="{{ student.id }}"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
