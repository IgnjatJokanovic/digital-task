require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import store from "./store";
import { routes } from "./router";
import MainApp from "./components/MainApp.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    mode: "history"
});

new Vue({
    el: "#app",
    router,
    components: {
        MainApp
    }
});
