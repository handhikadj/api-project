import Authenticate from '@/helpers/Helpers.js'
import Vue from 'vue'
import Router from 'vue-router'
import Auth from '@/components/Auth'
import Home from '@/components/Home'
import Dashboard from '@/components/home_view/Dashboard'
import Product from '@/components/product_view/Product'
import Purchase from '@/components/purchase_view/Purchase'
import Sale from '@/components/sale_view/Sale'
import Inventory from '@/components/inventory_view/Inventory'

Vue.use(Router)

const router = new Router({

	mode: 'history',
	routes: [
		{
			path: '/login', component: Auth, alias: '/',
			name: 'login',
		},
		{
			path: '/home', component: Home,
			children: [
				{
					path: '/', component: Dashboard,
				},
				{
					path: '/product', component: Product,
				},
				{
					path: '/purchase', component: Purchase,
				},
				{
					path: '/sale', component: Sale,
				},
				{
					path: '/inventory', component: Inventory,
				},
				
			]
		},
	]	
})

router.beforeEach(Authenticate)

export default router