import axios from "axios";

const state = {
    articles: []
};

const getters = {
    allArticles: state => state.user
};

const actions = {
    async fetchPosts({ commit }) {
        const res = await axios.get("/api/");
        console.log(res.data);
        // commit("setPosts", res.data);
    }
};

const mutations = {
    setPosts: (state, articles) => (state.articles = articles)
};

export default {
    state,
    getters,
    actions,
    mutations
};
