<template>
    <div v-html="autoLinkedHtml" />
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
        autoLinkedHtml() {
            return Autolinker.link(this.html)
        }
    }
}
</script>