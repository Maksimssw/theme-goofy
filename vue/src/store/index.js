import Vue from 'vue'
import Vuex from 'vuex'

import Modal from './modules/Modal';
import Options from "./modules/Options";
import Templates from "./modules/Templates";
import MagicChecker from "./modules/MagicChecker";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    Modal, Options, Templates, MagicChecker
  }
})
