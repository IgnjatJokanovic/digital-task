import axios from "axios";

const state = {
    article: {
        title: "",
        img: "",
        body: ""
    }
};

const getters = {
    allArticles: state => state.user
};

const actions = {
    setTitle({ commit }, title) {
        commit("setTitle", title);
    },
    setImg({ commit }, img) {
        commit("setImg", img);
    },
    setBody({ commit }, body) {
        commit("setBody", body);
    }
};

const mutations = {
    setTitle: (state, title) =>
        (state.title = { ...state.title, title: title }),
    setImg: (state, img) => (state.img = { ...state.img, title: img }),
    setBody: (state, body) => (state.body = { ...state.body, title: body })
};

export default {
    state,
    getters,
    actions,
    mutations
};
