import $ from "jquery"
import Vue from "vue"
import App from "./CategoryApp/App.vue"
import VueRouter from "vue-router"
import VueResource from "vue-resource"
import {ROUTES} from "./CategoryApp/Routes/MainRoutes";

$(document).ready(function($) {
	Vue.use(VueRouter)
	Vue.use(VueResource)

	let router = new VueRouter({
		routes: ROUTES
	})

	Vue.http.options.emulateJSON = true

	const app = new Vue({
		el: '#category_app',
		http: {
			root: '/profile/partner/agent/',
		},
		router: router,
		render: h => h(App)
	});	
});



