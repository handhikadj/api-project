import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import axios from 'axios'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import VeeValidate from 'vee-validate'
import Swal from 'sweetalert'

Vue.config.productionTip = false
Vue.prototype.$axios = axios
Vue.prototype.$swal = Swal

let lumenme = `http://${location.hostname}/api-project/lumen-complete/public`
let localGet = localStorage.getItem('api_token')

axios.defaults.baseURL = lumenme
axios.defaults.headers.common['Authorization'] = `Bearer ${localGet}`

Vue.use(Vuetify)
Vue.use(VeeValidate)

/* eslint-disable no-new */
new Vue({
	el: '#app',
	router,
	store,
	render: h => h(App)
})
