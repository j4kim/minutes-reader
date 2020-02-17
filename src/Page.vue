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
        this.scrollTo(".router-link-active")
    },
    methods: {
        scrollTo(selector){
            let el = document.querySelector(selector)
            if(el){
                el.scrollIntoView()
            }
        },
        mark() {
            let search = this.$route.query.search
            let inst = this.markInstance
            let scrollTo = this.scrollTo
            inst.unmark({
                done(){
                    if (search) {
                        inst.mark(search, {
                            separateWordSearch: false,
                            done(){
                                scrollTo("mark")
                            }
                        })
                    }
                }
            });
        }
    },
    watch:{
        $route(){
            this.mark()
        }
    }
}
</script>