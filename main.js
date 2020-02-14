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
    }),
    methods: {
        updateRouteQuery(newQuery = {tag:undefined, search:undefined}) {
            this.$router.replace({
                ...this.$router.currentRoute,
                query: Object.assign({}, this.$route.query, newQuery)
            }).catch(err => {})
        }
    }
}).$mount('#app')