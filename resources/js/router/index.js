import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)
const routers = require("./index.json");
routers.routes.forEach((route) => {
    route.component = require('../' + route.component).default;
});
export default new VueRouter(routers);