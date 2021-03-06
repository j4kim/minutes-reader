import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Page from './Page.vue'

Vue.use(VueRouter)

new Vue({
    render: h => h(App),
    router: new VueRouter({
        routes: [{
            path: "/",
            component: {
                render: h =>  h("i", "<-- Veuillez sélectionner un PV dans la liste")
            }
        },{
            path: "/:page",
            component: Page
        }]
    }),
    methods: {
        updateRouteQuery(newQuery) {
            this.$router.replace({
                ...this.$router.currentRoute,
                query: Object.assign({}, this.$route.query, newQuery)
            }).catch(err => {})
        },
        applyTagFilter(tag = "") {
            this.updateRouteQuery({tag: tag || undefined})
        },
        applySearchFilter(search = "") {
            this.updateRouteQuery({search: search || undefined})
        }
    }
}).$mount('#app')