import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Page from './Page.vue'

Vue.use(VueRouter)

new Vue({
    render: h => h(App),
    router: new VueRouter({
        routes: [{
            path: "/:page",
            component: Page
        }]
    })
}).$mount('#app')