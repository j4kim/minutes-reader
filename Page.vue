<template>
    <div :style="{ marginBottom: '40px' }">
        <div v-html="page.html" />
        <tags :tags="page.tags" />
    </div>
</template>

<script>
import Tags from "./Tags.vue"

export default {
    components: { Tags },
    computed: {
        page() {
            return this.$parent.pages.find(p => {
                return this.$route.params.page === p.name
            }) || { html: "Chargement..." }
        }
    }
}
</script>