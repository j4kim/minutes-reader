<template>
    <div>
        <router-link :to="page.name">
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