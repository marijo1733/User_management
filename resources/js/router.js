import  * as Vue from 'vue';
import * as VueRouter from 'vue-router';
import Admin from "./components/Admin.vue";

Vue.use(VueRouter);

const routes = [
    { path: "/", redirect: "/login" },
    { path: "/login", component: Login, name: "Login" },
    {
        path: "/admin",
        component: Admin,
        name: "Admin",
        //children: [{ path: "roles", component: Roles, name: "Roles" }],
  
    }
];

const router = new VueRouter({
    routes
});
const app = createApp(MyApp)
app.use(VueRouter)
// Global protected routes
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    // Promise of Authorization Bearer
    window.axios.defaults.headers["Authorization"] = "Bearer " + token;
    next();
});

export default router;