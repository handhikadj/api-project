import Authenticate from '@/helpers/Helpers.js'
import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Dashboard from '@/components/home_view/Dashboard'
import Product from '@/components/product_view/Product'

Vue.use(Router)

const router = new Router({

	mode: 'history',
	routes: [
		{
			path: '/login', component: Home, alias: '/', 
			name: 'login',
		},
		{
			path: '/home', component: Dashboard,
			name: 'homePage'
		},
		{
			path: '/product', component: Product,
		},

	]	
})

router.beforeEach(Authenticate)

export default router