{% extends "base.html" %}

{% block title %}Home{% endblock %}

{% block body %}
    <h1>Students list</h1>
    <div class="row">
        <div class="col">
            <table
                id="students"
                class="table table-striped"
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
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
