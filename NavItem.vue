<template>
    <div>
        <router-link :to="{ path: page.name, query: $route.query }">
            {{ page.title }}
        </router-link>
        <tags :tags="page.tags" />
    </div>
</template>

<script>
import Tags from "./Tags.vue"

export default {
    components: { Tags },
    props: ["page"]
}
</script>