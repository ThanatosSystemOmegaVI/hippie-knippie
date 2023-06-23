import { createWebHistory, createRouter } from "vue-router";

import Home from '@/components/index.vue';
let authenticated = sessionStorage.email !== undefined && sessionStorage.email !== null && sessionStorage.email !== "" && sessionStorage.email.length > 0 ? true : false;

export const routes = [
	{
		name: 'home',
		path: '/',
		component: Home
	},
	{
		name: 'login',
		path: '/login',
		component: () => import('@/components/login.vue')
	},
	{
		name: 'dashboard',
		path: '/dashboard',
		component: () => import('@/components/dashboard.vue'),
		meta: { authRequired: true },
	},
	{
		name: 'diensten',
		path: '/dashboard/diensten',
		component: () => import('@/components/diensten.vue'),
		meta: { authRequired: true },
	},
	{
		name: 'contactverzoeken',
		path: '/dashboard/contactverzoeken',
		component: () => import('@/components/contactverzoeken.vue'),
		meta: { authRequired: true },
	},
	{
		name: '404',
		path: "/:pathMatch(.*)*",
		component: Home
	}
];

const router = createRouter({
	history: createWebHistory(),
	routes: routes,
});

router.beforeEach((to, from, next) => {
	if (to.meta.authRequired) {
		if (authenticated) {
			next();
		} else {
			next('/login');
		}
	} else {
		next();
	}
});

export default router;