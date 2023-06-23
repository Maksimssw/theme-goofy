const state = {
    modal: null
};

const getters = {
    MODAL: (state) => {
        return state.modal;
    },
};

const mutations = {
    SET_MODAL: (state, payload) => {
        state.modal = payload;
    },
};

const actions = {
    INIT_MODAL: async (context, payload) => {
        context.commit("SET_MODAL", payload);
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
