<template>
    <router-link
        class="nav-link"
        :to="{ path: page.name, query: $route.query }"
        tag="li"
    >
        <div>{{ page.title }}</div>
        <small>
            <span class="date">{{ date }}</span>
            <tags :tags="page.tags" />
        </small>
    </router-link>
</template>

<script>
import Tags from "./Tags.vue"
import moment from "moment"

export default {
    components: { Tags },
    props: ["page"],
    computed: {
        date() {
            return moment(
                this.page.name.slice(0,10)
            ).format("DD.MM.YYYY")
        }
    }
}
</script>

<style lang="scss">
#app{
    .nav-link{
        cursor: pointer;
        div{
            color:#0366d6;
            line-height: 1.4;
        }
        &:hover{
            background-color: #eaecef;
            text-decoration:none;
        }
        &.router-link-active{
            background-color: #eaecef;
            div{ color: #24292e }
        }
    }
}
</style>