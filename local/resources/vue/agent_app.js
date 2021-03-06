import Vue from "vue"
import App from "./AgentApp/App.vue"
import VueRouter from "vue-router"
import VueResource from "vue-resource"
import {ROUTES} from "./AgentApp/Routes/MainRoutes"
import $ from "jquery"

$(document).ready(() => {
	Vue.use(VueRouter)
	Vue.use(VueResource)

	var router = new VueRouter({
		routes: ROUTES
	})

	Vue.http.options.emulateJSON = true

	var app = new Vue({
		el: '#agent_app',
		http: {
			root: '/profile/partner/agent/'
		},
		router: router,
		render: h => h(App)
	})
})



