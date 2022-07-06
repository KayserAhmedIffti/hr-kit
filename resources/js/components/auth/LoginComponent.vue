<template>
    <div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div
                        class="col-lg-5 d-none d-lg-block bg-register-image"
                    ></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login!</h1>
                            </div>
                            <form class="user" @submit.prevent="login()">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                v-model="form.email"
                                                class="form-control form-control-user"
                                                id="exampleInputEmail"
                                                placeholder="Email Address"
                                            />

                                            <span
                                                class="text-danger"
                                                v-text="
                                                    formErrors.email &&
                                                    formErrors.email[0]
                                                "
                                            ></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <!-- <p >{{form.password}}</p> -->
                                        <input
                                            type="password"
                                            v-model="form.password"
                                            class="form-control form-control-user"
                                            id="exampleInputPassword"
                                            placeholder="Password"
                                        />

                                        <span
                                            class="text-danger"
                                            v-text="
                                                formErrors.password &&
                                                formErrors.password[0]
                                            "
                                        ></span>
                                    </div>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-user btn-block"
                                >
                                    Login
                                </button>
                            </form>
                            <hr />
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <router-link class="small" to="/register"
                                    >Doesn't have an account?
                                    Register!</router-link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from "./Auth.js";
export default {
    name: "RegisterComponent",
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            formErrors: [],
        };
    },
    methods: {
        login() {
            axios
                .post("/api/v1/auth/login", this.form)
                .then(({ data }) => {
                    Auth.login(data.access_token, data.user);
                    this.$router.push("/");
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
    },
    created() {
        if (this.auth.check()) {
            this.$router.push("/");
        }
    },
};
</script>

<style scoped></style>
