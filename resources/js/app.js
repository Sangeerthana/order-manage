import './bootstrap';
import {createApp} from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

import Notifications from '@kyvg/vue3-notification'

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net'
import 'datatables.net-select'

import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

import App from './App.vue'

import Home from './page/Home.vue'
import About from './page/About.vue'
import Orders from './page/Orders.vue'
import EbayOrders from './page/GetEbayOrders.vue'
import Signup from './Authentication/Signup.vue'
import Signin from './Authentication/Signin.vue'
import Date from './page/Date.vue'
import Test from './Authentication/Test.vue'
import Thinu from './Authentication/Thinu.vue'
import Store from './page/StoreIntegrations.vue'

import Sangeerthana from './page/Sangeerthana.vue'
import Chart from './page/chart.vue'

const routes = [
	{path: '/', component: Home},
	{path: '/signup', component: Signup},
	{path: '/signin', component: Signin},
	{path: '/about', component: About},
	{path: '/orders', component: Orders},
	{path: '/date', component: Date},
	{path: '/test', component: Test},
	{path: '/thinu', component: Thinu},
	{path: '/store', component: Store},
	{path: '/get-ebay-orders', component: EbayOrders },
	{path: '/sangeerthana', component: Sangeerthana},
    {path: '/chart', component: Chart}
];

const router = createRouter({
	history: createWebHistory(),
	routes,
})

DataTable.use(DataTablesLib);
const app = createApp(App)
app.component('Datepicker', Datepicker);
app.use(Antd)
app.use(Notifications)
app.use(router)
app.mount("#app")


