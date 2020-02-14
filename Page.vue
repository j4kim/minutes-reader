<template>
    <div :style="{ marginBottom: '40px' }">
        <div v-html="page.html" ref="pageContent" />
        <tags :tags="page.tags" />
    </div>
</template>

<script>
import Mark from "mark.js"
import Tags from "./Tags.vue"

export default {
    components: { Tags },
    data() {
        return { markInstance: undefined }
    },
    mounted() {
        this.markInstance = new Mark(this.$refs.pageContent);
    },
    methods: {
        mark() {
            let search = this.$route.query.search
            let inst = this.markInstance
            inst.unmark({
                done(){
                    if (search) {
                        inst.mark(search)
                    }
                }
            });
        }
    },
    computed: {
        page() {
            return this.$parent.pages.find(p => {
                return this.$route.params.page === p.name
            }) || { html: "Chargement..." }
        }
    },
    watch: {
        "$route": function(){ this.mark() },
    }
}
</script>