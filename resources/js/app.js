/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";
import VueRouter from "vue-router";
import axios from "axios";
import VueAxios from "vue-axios";
import Auth from "./components/auth/Auth.js";
import Toasted from 'vue-toasted';
import LaravelVuePagination from 'laravel-vue-pagination';



import ExampleComponent from "./components/ExampleComponent";
import HomeComponent from "./components/HomeComponent";
import LoginComponent from "./components/auth/LoginComponent";
import RegisterComponent from "./components/auth/RegisterComponent";
import DashboardComponent from "./components/DashboardComponent";
import DepartmentComponent from "./components/employee/DepartmentComponent";
import HolidayComponent from "./components/employee/HolidayComponent";
import LeaveComponent from "./components/employee/LeaveComponent";
import EmployeeComponent from "./components/employee/EmployeeComponent";
import EmployeeDataComponent from "./components/employee/EmployeeDataComponent";
import PositionComponent from "./components/employee/PositionComponent";

require("./bootstrap");

window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use('pagination',LaravelVuePagination);
Vue.use(VueAxios, axios);
Vue.prototype.auth = Auth;
window.axios = axios;
Vue.component("pagination", require("laravel-vue-pagination"));

Vue.config.productionTip = false
Vue.use(Toasted, {
  duration: 1000
});

window.API_PREFIX = "/api/v1"

const routes = [
    {
        path: "/",
        name: "Home",
        component: HomeComponent,
        children: [
            {
                path: "/",
                name: "Dashboard",
                component: DashboardComponent,
            },
            {
                path: "/dashboard",
                name: "Dashboard",
                component: DashboardComponent,
            },
            {
                path: "/departments",
                name: "Department",
                component: DepartmentComponent,
            },
            {
                path: "/holidays",
                name: "Holiday",
                component: HolidayComponent,
            },
            {
                path: "/leaves",
                name: "Leave",
                component: LeaveComponent,
            },
            {
                path: "/employees",
                name: "employees",
                component: EmployeeComponent,
            },
            {
                path: "/employees/:id/edit",
                name: "employees-edit",
                component: EmployeeComponent,
            },
            {
                path: "/employees/data",
                name: "employeeData",
                component: EmployeeDataComponent,
            },
            {
                path:'/departments',
                name:'Department',
                component : DepartmentComponent
            },
            {
                path:'/positions',
                name:'Position',
                component : PositionComponent
            }
        ],
    },
    {
        path: "/register",
        name: "Register",
        component: RegisterComponent,
    },
    {
        path: "/login",
        name: "Login",
        component: LoginComponent,
    },
];

let router = new VueRouter({
    mode: "history",
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push("/login");
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: "#app",
    router,
});
