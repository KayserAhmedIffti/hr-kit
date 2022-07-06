<template>
    <div class="container">
        <h1 class="text-dark">Holiday Overview</h1>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <form @submit.prevent="postHoliday()">
                    <div class="card" style="padding: 3%">
                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >Holiday &nbsp;
                                    <span class="badge badge-danger"
                                        >Required</span
                                    ></label
                                >
                            </div>
                            <div class="form-input">
                                <input
                                    type="text"
                                    id="holiday"
                                    v-model="form.holiday"
                                    class="form-control border border-dark"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="
                                    formErrors.holiday && formErrors.holiday[0]
                                "
                            >
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >Start Date &nbsp;
                                    <span class="badge badge-danger"
                                        >Required</span
                                    ></label
                                >
                            </div>
                            <div class="form-input">
                                <input
                                    type="date"
                                    id="date"
                                    v-model="form.date"
                                    class="form-control border border-dark"
                                />
                            </div>
                            <span
                                class="text-danger"
                                v-text="formErrors.date && formErrors.date[0]"
                            >
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label class="text-dark"
                                    >End date &nbsp;
                                    <span class="badge badge-danger"
                                        >Required</span
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
                            <th class="border-dark text-dark">Holiday</th>
                            <th class="border-dark text-dark">Start Date</th>
                            <th class="border-dark text-dark">End Date</th>
                            <th class="border-dark text-dark">Action</th>
                        </tr>
                        <tr
                            class="border-dark"
                            v-for="(holidayVariable, index) in holidayData.data"
                            :key="index"
                        >
                            <td class="border-dark text-dark">
                                {{ index + 1 }}
                            </td>
                            <td class="border-dark text-dark">
                                {{ holidayVariable.holiday }}
                            </td>
                            <td class="border-dark text-dark">
                                {{ holidayVariable.date }}
                            </td>
                            <td class="border-dark text-dark">
                                {{ holidayVariable.end_date }}
                            </td>
                            <td class="border-dark text-dark">
                                <button class="btn btn-primary" @click="editEmployee(holidayVariable.id)">Edit</button>
                                <button class="btn btn-danger" @click="deleteEmployee(holidayVariable.id)">Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <pagination
                    align="center"
                    :data="holidayData"
                    @pagination-change-page="getHoliday"
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
import axios from 'axios';
export default {
    name: "HolidayComponent",
    data() {
        return {
            form: {
                holiday: "",
                date: "",
                end_date: "",
            },
            formErrors: [],
            holidayData: [],
        };
    },
    methods: {
        getHoliday(page = 1, perPage = 5) {
            const queryString = `page=${page}&per_page=${perPage}`;
            axios
                .get(`/api/v1/holidays?${queryString}`)
                .then((response) => {
                    this.holidayData = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        postHoliday() {
           if(this.form.id){
              axios
              .put(`/api/v1/holidays/${this.form.id}`,this.form)
              .then((response)=>{
                  
                  this.getHoliday();
                  this.clearHolidayForm();
              })
              .catch((error)=>{
                  console.log(error);
              })
           }
           else{
                axios
                .post("/api/v1/holidays", this.form)
                .then((response) => {
                    console.log(response);
                    this.getHoliday();
                    this.clearHolidayForm();
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
            }
        },
        editEmployee(id){
           axios
           .get(`/api/v1/holidays/${id}`)
           .then((response)=>{
               this.form=response.data.data;
           })
           .catch((error)=>{
                console.log(error);
           }
           );
        },
        deleteEmployee(id){
            axios
            .delete(`/api/v1/holidays/${id}`)
            .then((resonse)=>{
                
            })
            .catch((error)=>{
                console.log(error);
            })
            .finally(()=>{
                this.getHoliday();
            })
        },
        clearHolidayForm(){
           this.form.id=null;
           this.form.holiday="";
           this.form.date="";
           this.form.end_date="";

        },
    },
    mounted() {
        this.getHoliday();
    },
};
</script>

<style scoped></style>
