import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import store from './store'
import { iconsSet as icons } from './assets/icons/icons.js'

Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.prototype.$log = console.log.bind(console)
require('../bootstrap');

new Vue({
  components: { App },
  router,
  icons,
  store,
  template: "<App/>",
  render: h => h(App),
}).$mount("#app");
