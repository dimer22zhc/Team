import Vue from 'vue'

import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
Vue.use(Antd)

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

import checkView from 'vue-check-view'
Vue.use(checkView)

// import Echo from "laravel-echo"
// import Cookies from 'js-cookie'

// let token = Cookies.get('token')
// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//   authEndpoint: `http://127.0.0.1:8000/broadcasting/auth`,
//   auth: {
//     headers: {
//       Authorization: `Bearer ${token}`
//     },
//   },
//   broadcaster: 'pusher',
//   key: 'dimer-bwimba',
//   wsHost: window.location.hostname,

//   wsPort: 6001,
//   disableStats: true,
// });
// // /**
// //  * Alternatively you can pass an echo instance:
// //  * ********************************************
// //  */
