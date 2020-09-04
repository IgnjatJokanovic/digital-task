import Vuex from "vuex";
import Vue from "vue";
import { values } from "lodash";
import articles from "./modules/articles";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        articles
    }
});
