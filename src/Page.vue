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
    props: ["page"],
    data() {
        return { markInstance: undefined }
    },
    mounted() {
        this.markInstance = new Mark(this.$refs.pageContent);
    },
    updated() {
        this.mark()
        let activeLinkEl = document.querySelector(".router-link-active")
        if(activeLinkEl){
            activeLinkEl.scrollIntoView()
        }
    },
    methods: {
        mark() {
            let search = this.$route.query.search
            let inst = this.markInstance
            inst.unmark({
                done(){
                    if (search) {
                        inst.mark(search, {
                            separateWordSearch: false
                        })
                    }
                }
            });
        }
    }
}
</script>