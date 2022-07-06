<template>
    <div class="container">
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Emplpoyee ID</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Date of Birth</th>
                        <th>National ID</th>
                        <th>Mobile No</th>
                        <th>Religion</th>
                        <th>Nominee</th>
                        <th>Spouse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(EmployeeVariable, index) in employeeData.data"
                        :key="index"
                    >
                        <td>{{ EmployeeVariable.first_name }}</td>
                        <td>{{ EmployeeVariable.last_name }}</td>
                        <td>{{ EmployeeVariable.employee_id }}</td>
                        <td>{{ EmployeeVariable.father_name }}</td>
                        <td>{{ EmployeeVariable.mother_name }}</td>
                        <td>{{ EmployeeVariable.dob }}</td>
                        <td>{{ EmployeeVariable.n_id }}</td>
                        <td>{{ EmployeeVariable.mobile }}</td>
                        <td>{{ EmployeeVariable.religion }}</td>
                        <td>{{ EmployeeVariable.nominee }}</td>
                        <td>{{ EmployeeVariable.spouse }}</td>
                        <td class="border-dark text-dark">
                            <router-link
                                class="btn btn-primary"
                                :to="`/employees/${EmployeeVariable.id}/edit`"
                                >Edit</router-link
                            >
                            <button
                                class="btn btn-danger"
                                @click="deleteEmployee(EmployeeVariable.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination
            align="center"
            :data="employeeData"
            @pagination-change-page="getEmployeeData"
        >
            <template #prev-nav>
                <span>&lt; Previous</span>
            </template>
            <template #next-nav>
                <span>Next &gt;</span>
            </template>
        </pagination>
    </div>
</template>

<script>
export default {
    name: "EmployeeDataComponent",
    data() {
        return {
            form: {
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
            employeeData: {},
        };
    },
    methods: {
        getEmployeeData(page = 1, perPage = 5) {
            const queryString = `page=${page}&per_page=${perPage}`;
            axios
                .get(`/api/v1/employees?${queryString}`)
                .then((response) => {
                    this.employeeData = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        postByEmployeeId() {
            if (this.form.id) {
                axios
                    .put(`/api/v1/employees/${this.form.id}`, this.form)
                    .then((response) => {
                        this.getEmployeeData();
                        this.clearHolidayForm();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        deleteEmployee(id) {
            axios
                .delete(`/api/v1/employees/${id}`)
                .then((resonse) => {})
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.getEmployeeData();
                });
        },

        clearEmployeeForm() {
            this.form.first_name = "";
            this.form.last_name = "";
            this.form.employee_id = "";
            this.form.father_name = "";
            this.form.mother_name = "";
            this.form.dob = "";
            this.form.n_id = "";
            this.form.mobile = "";
            this.form.religion = "";
            this.form.nominee = "";
            this.form.spouse = "";
        },
    },
    mounted() {
        this.getEmployeeData();
    },
};
</script>
