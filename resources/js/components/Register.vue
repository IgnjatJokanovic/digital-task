
<template>
  <div class="container">
    <h1>Register</h1>Email:
    <input type="text" v-model="user.email" />
    Name:
    <input type="text" v-model="user.name" />
    Password:
    <input type="password" v-model="user.password" />
    <button @click="register">Register</button>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Register",
  data() {
    return {
      user: {
        email: "",
        name: "",
        password: "",
      },
    };
  },
  methods: {
    register() {
      axios
        .post("/api/register", this.user)
        .then((res) => alert(res.data))
        .catch((err) => alert(err.response.data.messages[0]));
    },
  },
};
</script>