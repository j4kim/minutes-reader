<template>
    <div id="app" class="markdown-body">
        <slideout menu="#sidebar" panel="#content" :toggleSelectors="['.toggle-button']">
            <nav id="sidebar">
                <input placeholder="Recherche" v-model="search" type="search" />
                <div v-if="$route.query.tag">
                    Tag: {{ $route.query.tag }}
                    <button @click="$root.applyTagFilter()">✕</button>
                </div>
                <hr>
                <ul v-if="filteredPages.length">
                    <li v-for="page in filteredPages" :key="page.name">
                        <nav-item :page="page" />
                    </li>
                </ul>
            </nav>
            <main id="content">
                <div>
                    <button class="toggle-button">☰</button>
                </div>
                <div :style="{textAlign:'right',padding:'10px', marginBottom:'-20px'}">
                    <a
                        v-if="$route.params.page"
                        :href="editLinkBase + $route.params.page"
                        target="_blank"
                    >Editer</a>
                </div>
                <router-view :page="page" />
            </main>
        </slideout>
    </div>
</template>

<script>
import Slideout from "vue-slideout"
import NavItem from "./NavItem.vue"

export default {
    components: { NavItem, Slideout },
    data() {
        return { pages: [], allTags: {} }
    },
    created(){
        fetch("get_content.php")
            .then(response => response.json())
            .then(pages => pages.map(this.setTags))
            .then(pages => pages.map(this.setSearchContent))
            .then(pages => this.pages = pages)
    },
    methods: {
        setTags(page) {
            page.tags = page.tags.map(tagName => {
                let existingTag = this.allTags[tagName]
                if (existingTag) {
                    return existingTag
                }
                let newTag = {
                    name: tagName,
                    id: Object.values(this.allTags).length
                }
                this.allTags[tagName] = newTag
                return newTag
            })
            return page
        },
        setSearchContent(page) {
            page.searchContent = page.content.toLowerCase()
            return page
        },
        tagCheck(page) {
            let tagName = this.$route.query.tag
            return tagName ?
                page.tags.some(t => t.name === tagName) :
                true
        },
        searchCheck(page) {
            return page.searchContent.includes(this.searchTerm)
        },
    },
    computed: {
        editLinkBase() {
            return document.body.dataset.editLinkBase
        },
        filteredPages(){
            return this.pages
                .filter(this.tagCheck)
                .filter(this.searchCheck)
        },
        searchTerm() {
            return (this.$route.query.search || "").toLowerCase()
        },
        search: {
            get() {
                return this.$route.query.search
            },
            set(search) {
                this.$root.applySearchFilter(search)
            },
        },
        page() {
            return this.filteredPages.find(p => {
                return this.$route.params.page === p.name
            }) || { html: "" }
        }
    }
}
</script>

<style>
body {
    width: 100%;
    height: 100%;
    margin: 0;
}

.slideout-menu {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 256px;
    height: 100vh;
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch;
    z-index: 0;
    display: none;
    padding: 20px;
}
#sidebar ul{
    list-style: none;
    padding-left: 0;
    font-size: .9em;
    line-height: 1.4em;
}
#sidebar ul li{
    margin-bottom: .8em;
}

.slideout-panel {
    background: white;
    position: relative;
    z-index: 1;
    will-change: transform;
    min-height: 100vh;
}

.slideout-open .slideout-menu {
    display: block;
}
</style>