<template>
    <div v-html="html" />
</template>

<script>
export default {
    computed: {
        html() {
            var page = this.$parent.pages.find(p => {
                return this.$route.params.page === p.name
            })
            return page ? page.html : "Chargement..."
        },
    }
}
</script>