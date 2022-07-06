<template>
    <div class="container">
    
        <div class="row">
            <form class="user" @submit.prevent="postEmployee()">
                <div class="col-sm-12">
                    <div class="card" style="padding: 8%">
                        <div class="form-group">
                            <div class="form-label">
                                <label
                                    >Department-Name
                                    <small class="badge badge-danger"
                                        >Required</small
                                    >
                                </label>
                            </div>
                            <div class="form-input border border-dark">
                                <input
                                    type="text"
                                    id="department_name"
                                    v-model="form.department_name"
                                    class="form-control"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.department_name &&
                                    formErrors.department_name[0]
                                "
                            ></span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label
                                    >Department-Name Bn
                                    <small class="badge badge-danger"
                                        >Required</small
                                    ></label
                                >
                            </div>
                            <div class="form-input border border-dark">
                                <input
                                    type="text"
                                    id="department_bn"
                                    v-model="form.department_bn"
                                    class="form-control"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.department_bn &&
                                    formErrors.department_bn[0]
                                "
                            ></span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label
                                    >status
                                    <small class="badge badge-danger"
                                        >Required</small
                                    ></label
                                >
                            </div>
                            <div class="form-input border border-dark">
                                <select
                                    class="form-control"
                                    v-model="form.status"
                                >
                                    <option>Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.status && formErrors.status[0]
                                "
                            ></span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label>&nbsp;</label>
                            </div>
                            <div class="form-input text-center">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-user"
                                >
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-sm-8">
                <div class="card" style="padding: 1%">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Name Bn</th>
                            <th>status</th>

                            <th>Action</th>
                        </tr>
                        <tr
                            v-for="(department, index) in departmentData.data"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ department.department_name }}</td>
                            <td>{{ department.department_bn }}</td>
                            <td
                                :style="{
                                    color:
                                        department.status == 1
                                            ? 'green'
                                            : 'red',
                                }"
                            >
                                {{ department.status_text }}
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    @click="deleteEmployee(department.id)"
                                >
                                    Delete
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-warning"
                                    @click="editEmployee(department.id)"
                                >
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DepartmentComponent",
    data() {
        return {
            form: {
                id: null,
                department_name: "",
                department_bn: "",
                status: "",
            },
            formErrors: [],
            departmentData: [],
        };
    },
    methods: {
        getEmployee() {
            axios
                .get(`${API_PREFIX}/departments`)
                .then((response) => {
                    this.departmentData = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        editEmployee(id) {
            axios
                .get(`${API_PREFIX}/departments/${id}`)
                .then((response) => {
                    this.form = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        postEmployee() {
            if (this.form.id) {
                axios
                    .put(`${API_PREFIX}/departments/${this.form.id}`, this.form)
                    .then((response) => {
                        this.$toasted.success("Updated Successfully");
                        this.getEmployee();
                        this.clearDepartmentForm();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .post(`${API_PREFIX}/departments`, this.form)
                    .then((response) => {
                        console.log(response);
                        this.$toasted.success("Added Successfully");
                        this.getEmployee();
                        this.clearDepartmentForm();
                    })
                    .catch((error) => {
                        console.log(error);
                        this.formErrors = error.response.data.errors;
                    });
            }
        },
        deleteEmployee(id) {
            axios
                .delete(`${API_PREFIX}/departments/${id}`)
                .then((response) => {
                    this.$toasted.error("Deleted Successfully");
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.getEmployee();
                });
        },

        clearDepartmentForm() {
            this.form.id = null;
            this.form.department_name = "";
            this.form.department_bn = "";
            this.form.status = "";
        },
    },
    mounted() {
        this.getEmployee();
    },
};
</script>

<style scoped></style>
