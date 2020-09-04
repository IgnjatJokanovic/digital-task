<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item mr-3">
          <router-link to="/">Home</router-link>
        </li>
        <!-- <li v-if="!isAuthenticated" class="nav-item mr-3">
          <router-link to="/login">Login</router-link>
        </li>
        <li v-if="!isAuthenticated" class="nav-item mr-3">
          <router-link to="/register">Register</router-link>
        </li>

        <li v-if="isAuthenticated" class="nav-item mr-3">
          <router-link to="/insert">Insert Article</router-link>
        </li>-->

        <li class="nav-item mr-3">
          <router-link to="/login">Login</router-link>
        </li>
        <li class="nav-item mr-3">
          <router-link to="/register">Register</router-link>
        </li>

        <li class="nav-item mr-3">
          <router-link to="/insert">Insert Article</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
import { isAuthenticated } from "../helpers";
export default {
  name: "Nav",
};
</script>
