import Articles from "./components/articles/Articles.vue";
import Insert from "./components/articles/Insert.vue";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";

export const routes = [
    {
        path: "/",
        component: Articles
    },
    {
        path: "/insert",
        component: Insert
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/register",
        component: Register
    }
];
