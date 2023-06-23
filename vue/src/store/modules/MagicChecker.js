import axios from "axios";

const state = {
  campaigns: [],
};

const getters = {
  GET_MC: (state) => {
    return state.campaigns;
  },
};

const mutations = {
  SET_MC: (state, payload) => {
    state.campaigns = payload;
  }
};

const actions = {
  LOAD_MC: async (context) => {
    let { data } = await axios.get("/api/magicchecker");
    context.commit("SET_MC", data);
  },
  UPDATE_MC: async (context, data) => {

    data = data.filter(item => item.key != '');

    // Delete Items
    let deletedItems = state.campaigns.filter((x)=> !data.includes(x));
    let formated = [];
    for (let i = 0; i < deletedItems.length; i++) {
      formated.push(deletedItems[i].key)
    }
    if (formated.length > 0)
      axios.delete("/api/magicchecker", { data: formated }).catch((error) => {
        console.log(error);
      });

    // Patch Items
    let updatedItems = data.filter((x)=> state.campaigns.includes(x));
    if (updatedItems.length > 0)
      axios.patch("/api/magicchecker", updatedItems).catch((error) => {
        console.log(error);
      });
     
    //Insert Items
    let newItems = data.filter((x) => !state.campaigns.includes(x));  
    if(newItems.length > 0)
      axios.post("/api/magicchecker",newItems).catch(error =>{
        console.log(error);
      });

    // Save to state
    context.commit("SET_MC", data);
  }
};

export default {
  state,
  getters,
  mutations,
  actions,
};
