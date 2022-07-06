<template>
    <div class="container">
        <h3>Employee Data Entry</h3>
        <form @submit.prevent="postEmployee()">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >First Name &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="first_name"
                                class="form-control border border-dark"
                                v-model="form.first_name"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="
                                formError.first_name && formError.first_name[0]
                            "
                        >
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Last Name &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="last_name"
                                class="form-control border border-dark"
                                v-model="form.last_name"
                            />
                        </div>
                        <span class="text-danger" v-text="formError.last_name">
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Employee ID &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="employee_id"
                                class="form-control border border-dark"
                                v-model="form.employee_id"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="
                                formError.employee_id &&
                                formError.employee_id[0]
                            "
                        ></span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Father Name &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="father_name"
                                class="form-control border border-dark"
                                v-model="form.father_name"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="
                                formError.father_name &&
                                formError.father_name[0]
                            "
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Mother Name &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="mother_name"
                                class="form-control border border-dark"
                                v-model="form.mother_name"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="
                                formError.mother_name &&
                                formError.mother_name[0]
                            "
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Date of Birth &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="date"
                                id="dob"
                                class="form-control border border-dark"
                                v-model="form.dob"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.dob && formError.dob[0]"
                        >
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >NID &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="n_id"
                                class="form-control border border-dark"
                                v-model="form.n_id"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.n_id && formError.n_id[0]"
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Mobile &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="mobile"
                                class="form-control border border-dark"
                                v-model="form.mobile"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.mobile && formError.mobile[0]"
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Religion &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="religion"
                                class="form-control border border-dark"
                                v-model="form.religion"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.religion && formError.religion[0]"
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Nominee &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="nominee"
                                class="form-control border border-dark"
                                v-model="form.nominee"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.nominee && formError.nominee[0]"
                        >
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Spouse &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <input
                                type="text"
                                id="spouse"
                                class="form-control border border-dark"
                                v-model="form.spouse"
                            />
                        </div>
                        <span
                            class="text-danger"
                            v-text="formError.spouse && formError.spouse[0]"
                        >
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >Department ID &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <select
                                class="form-select form-select-lg mb-3 form-control border border-dark"
                                aria-label=".form-select-lg example"
                            >
                                <option value="1" selected>One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <span class="text-danger"> </span>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-label">
                            <label class="text-dark"
                                >position ID &nbsp;
                                <span class="badge badge-danger"
                                    >Required</span
                                ></label
                            >
                        </div>
                        <div class="form-input">
                            <select
                                class="form-select form-select-lg mb-3 form-control border border-dark"
                                aria-label=".form-select-lg example"
                            >
                                <option value="1" selected>One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <span class="text-danger"> </span>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-left: 300px">
                <div class="form-label">
                    <label>&nbsp;</label>
                </div>
                <div class="form-input">
                    <input
                        type="submit"
                        value="Save"
                        class="btn btn-success"
                        style="padding: 5px 50px"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "EmployeeComponent",
    data() {
        return {
            form: {
                id: "",
                first_name: "",
                last_name: "",
                employee_id: "",
                father_name: "",
                mother_name: "",
                dob: "",
                n_id: "",
                mobile: "",
                religion: "",
                nominee: "",
                spouse: "",
            },
            formError: [],
            employeeData: [],
        };
    },
    computed: {
        editId() {
            return this.$route.params.id;
        },
    },
    methods: {
        postEmployee() {
            axios
                .post("/api/v1/employees", this.form)
                .then((response) => {
                    console.log(response);
                    // this.getEmployee();
                    // this.clearEmployeeForm();
                    this.$router.push("/employees/data");
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },

        editEmployee() {
            axios
                .get(`/api/v1/employees/${this.editId}`)
                .then((response) => {
                    this.form = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        if (this.editId) {
            this.editEmployee();
        }
    },
};
</script>
