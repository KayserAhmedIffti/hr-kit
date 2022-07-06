<template>
    <div class="container">
        <div class="row">
            <form class="user" @submit.prevent="postEmployee()">
                <div class="col-sm-12">
                    <div class="card" style="padding: 8%">
                        <div class="form-group">
                            <div class="form-label">
                                <label
                                    >Position-Name
                                    <small class="badge badge-danger"
                                        >Required</small
                                    >
                                </label>
                            </div>
                            <div class="form-input border border-dark">
                                <input
                                    type="text"
                                    id="position_name"
                                    v-model="form.name"
                                    class="form-control"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="formErrors.name && formErrors.name[0]"
                            ></span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label
                                    >Position-Name Bn
                                    <small class="badge badge-danger"
                                        >Required</small
                                    ></label
                                >
                            </div>
                            <div class="form-input border border-dark">
                                <input
                                    type="text"
                                    id="position_bn"
                                    v-model="form.name_bn"
                                    class="form-control"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.name_bn && formErrors.name_bn[0]
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
                            v-for="(position, index) in positionData.data"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ position.name }}</td>
                            <td>{{ position.name_bn }}</td>
                            <td
                                :style="{
                                    color:
                                        position.status == 1 ? 'green' : 'red',
                                }"
                            >
                                {{
                                    position.status == 1 ? "Active" : "InActive"
                                }}
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    @click="deleteEmployee(position.id)"
                                >
                                    Delete
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-warning"
                                    @click="editEmployee(position.id)"
                                >
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </table>
                   
                   <div>
                        <pagination :data="positionData" @pagination-change-page="getEmployee" />
                   </div>

                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LaravelVuePagination from "laravel-vue-pagination";

export default {
    name: "PositionComponent",
    components: {
        'pagination' : LaravelVuePagination
    },
    data() {
        return {
            form: {
                id: null,
                name: "",
                name_bn: "",
                status: "",
            },
            formErrors: [],
            positionData: {},
        };
    },
    methods: {
        getEmployee(page = 1) {
            
            axios
                .get(`${API_PREFIX}/positions?page=${page}`)
                .then(({data}) => {
                    this.positionData = data.data;
                    
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        editEmployee(id) {
            axios
                .get(`${API_PREFIX}/positions/${id}`)
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
                    .put(`${API_PREFIX}/positions/${this.form.id}`, this.form)
                    .then((response) => {
                        this.$toasted.success("Updated Successfully");
                        this.getEmployee();
                        this.clearPositionForm();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .post(`${API_PREFIX}/positions`, this.form)
                    .then((response) => {
                        console.log(response);
                        this.$toasted.success("Added Successfully");
                        this.getEmployee();
                        this.clearPositionForm();
                    })
                    .catch((error) => {
                        console.log(error);
                        this.formErrors = error.response.data.errors;
                    });
            }
        },
        deleteEmployee(id) {
            axios
                .delete(`${API_PREFIX}/positions/${id}`)
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

        clearPositionForm() {
            this.form.id = null;
            this.form.name = "";
            this.form.name_bn = "";
            this.form.status = "";
        },
    },
    mounted() {
        this.getEmployee();
    },
};
</script>
