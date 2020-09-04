import axios from "axios";

const state = {
    user: {
        email: "",
        password: ""
    }
};

const getters = {
    userGetter: state => state.user
};

const actions = {};

const mutations = {};

export default {
    state,
    getters,
    actions,
    mutations
};
