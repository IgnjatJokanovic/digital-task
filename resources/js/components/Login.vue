<template>
    <div class="container">
        <h1>Login</h1>

        Email: <input type="text" v-model="user.email" /> Password:
        <input type="password" v-model="user.password" />
        <button @click="login">Login</button>
    </div>
</template>
<script>
import axios from "axios";
import { createCookie } from "../helpers";
export default {
    name: "Login",
    data() {
        return {
            user: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        login() {
            axios
                .post("/api/login", this.user)
                .then(res => {
                    createCookie(res.data.token);
                    window.location.href = "/";
                })
                .catch(err => alert(err.response.data.messages[0]));
        }
    }
};
</script>
