import axios from "axios";

const state = {
  templates: null
};

const getters = {
  GET_TEMPLATES: (state) => {
    return state.templates;
  },
};

const mutations = {
  SET_TEMPLATES: (state, payload) => {
    state.templates = payload;
  },
};

const actions = {
  LOAD_TEMPLATES: async (context) => {
    let { data } = await axios.get("/api/upload");
    context.commit("SET_TEMPLATES", data);
  },
};

export default {
  state,
  getters,
  mutations,
  actions,
};
