
import { createApp } from "vue";
import App from "./layouts/app.vue";
import vuetify from "./vuetify";
import "vuetify/dist/vuetify.min.css";
import { createRouter, createWebHistory } from 'vue-router';


import index from './components/index.vue';
import admin from './components/admin.vue';
import login from './components/Login.vue';
import register from './components/register.vue';
import edit from './components/edit.vue';




import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';



const routes = [
    { path: '/', component: index },
    { path: '/admin', component: admin },
    { path: '/register', component: register },
    { path: '/login', component: login },
    { path: '/edit/:id', component: edit },

  ];
  
const router = createRouter({
    history: createWebHistory(),
    routes,
  });


  createApp(App)

  .use(router)
  .use(vuetify)
  .mount('#app');
