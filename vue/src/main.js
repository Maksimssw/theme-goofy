import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import axios from "axios";
import cookie from "cookiejs";
import "@/assets/css/style.css";

Vue.config.productionTip = false;

// Axios
Vue.prototype.$http = axios;
let urlParams = new URLSearchParams(window.location.search);
let api_key = urlParams.get("api_key") || cookie.get('api_key');
if (api_key) {
  cookie.set('api_key', api_key, 14);
  Vue.prototype.$http.defaults.headers.common[
    "Authorization"
  ] = `Bearer ${api_key}`;
}

// Global Components
Vue.component("Preloader", require("./components/layout/Preloader.vue").default);

new Vue({
  store,
  render: (h) => h(App),
}).$mount("#app");
