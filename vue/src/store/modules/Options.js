import axios from "axios";

const state = {
  options: null
};

const getters = {
  GET_OPTIONS: (state) => {
    return state.options;
  },
};

const mutations = {
  SET_OPTIONS: (state, payload) => {
    state.options = payload;
  },
  SET_OPTION: (state, payload) => {
    for(let item in payload){
      state.options[item] = payload[item]
    }
  }
};

const actions = {
  LOAD_OPTIONS: async (context) => {
    let { data } = await axios.get("/api/options");
    context.commit("SET_OPTIONS", data);
  },
  UPDATE_OPTIONS: async (context, data)=>{
    axios.patch("/api/options", data).then(()=>{
      context.commit('SET_OPTION', data);
    }).catch(error =>{
      console.log(error);
    });
  }
};

export default {
  state,
  getters,
  mutations,
  actions,
};
