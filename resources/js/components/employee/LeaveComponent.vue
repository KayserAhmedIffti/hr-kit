<template>
    <div class="container">
        <h1 class="text-dark">Leave Type</h1>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <form @submit.prevent="postLeave()">
                    <div class="card" style="padding: 3%">
                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >Leave Type &nbsp;<span
                                        class="badge badge-danger"
                                        >required</span
                                    ></label
                                >
                            </div>

                            <div class="form-input">
                                <input
                                    type="text"
                                    id="leave_type"
                                    v-model="form.leave_type"
                                    class="form-control border border-dark"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.leave_type &&
                                    formErrors.leave_type[0]
                                "
                            >
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >Start Date &nbsp;<span
                                        class="badge badge-danger"
                                        >required</span
                                    ></label
                                >
                            </div>

                            <div class="form-input">
                                <input
                                    type="date"
                                    id="start_date"
                                    v-model="form.start_date"
                                    class="form-control border border-dark"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.start_date &&
                                    formErrors.start_date[0]
                                "
                            >
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >End date &nbsp;<span
                                        class="badge badge-danger"
                                        >required</span
                                    ></label
                                >
                            </div>
                            <div class="form-input">
                                <input
                                    type="date"
                                    id="end_date"
                                    v-model="form.end_date"
                                    class="form-control border border-dark"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.end_date &&
                                    formErrors.end_date[0]
                                "
                            >
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label>&nbsp;</label>
                            </div>
                            <div class="form-input text-center">
                                <input
                                    type="submit"
                                    value="Save"
                                    class="btn btn-success"
                                />
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-8 col-md-8">
                <div class="card" style="padding: 1%">
                    <table class="table table-bordered">
                        <tr class="border border-dark">
                            <th class="border-dark text-dark">SL</th>
                            <th class="border-dark text-dark">Leave Type</th>
                            <th class="border-dark text-dark">Start Date</th>
                            <th class="border-dark text-dark">End Date</th>
                        </tr>
                        <!-- <template
                            class="border-dark"
                            v-for="leaveTaken in leaveData.data"
                        > -->
                        <tr v-for="leaveTaken in leaveData.data">
                            <td class="border-dark text-dark"></td>
                            <td class="border-dark text-dark">
                                {{ leaveTaken.leave_type }}
                            </td>
                            <td class="border-dark text-dark">
                                {{ leaveTaken.start_date }}
                            </td>
                            <td class="border-dark text-dark">
                                {{ leaveTaken.end_date }}
                            </td>
                        </tr>
                        <!-- </template> -->
                    </table>
                </div>
                <pagination
                    :data="leaveData"
                    @pagination-change-page="getLeaveData"
                >
                    <template #prev-nav>
                        <span>&lt; Previous</span>
                    </template>
                    <template #next-nav>
                        <span>Next &gt;</span>
                    </template>
                </pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LeaveComponent",
    data() {
        return {
            form: {
                leave_date: "",
                start_date: "",
                end_date: "",
            },
            formErrors: [],
            leaveData: {},
        };
    },
    methods: {
        getLeaveData(page = 1, perPage = 10) {
            const queryString = `page=${page}&per_page=${perPage}`;
            axios
                .get(`/api/v1/leaves?${queryString}`)
                .then((response) => {
                    this.leaveData = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        postLeave() {
            axios
                .post("/api/v1/leaves", this.form)
                .then((response) => {
                    console.log(response);
                    this.getLeaveData();
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },

    mounted() {
        this.getLeaveData();
    },
};
</script>

<style scoped></style>
