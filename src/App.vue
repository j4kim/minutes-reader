<template>
    <slideout menu="#sidebar" panel="#content" :toggleSelectors="['.toggle-button']" id="app" class="markdown-body">
        <nav id="sidebar">
            <header class="pad20">
                <input placeholder="Recherche" v-model="search" type="search" />
                <div v-if="$route.query.tag">
                    Tag: {{ $route.query.tag }}
                    <button @click="$root.applyTagFilter()">✕</button>
                </div>
            </header>
            <ul v-if="filteredPages.length">
                <nav-item v-for="page in filteredPages" :key="page.name" :page="page" />
            </ul>
        </nav>
        <main id="content" class="pad20">
            <button class="toggle-button">☰</button>
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

<style lang="scss">
body {
    width: 100%;
    height: 100%;
    margin: 0;
}

#sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 256px;
    height: 100vh;
    z-index: 0;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #eaecef;

    ul {
        list-style:none;
        padding:0;
        overflow: auto;
        margin: 0;
        li{
            padding: 6px 20px 8px 20px;
            margin: 0;
        }
    }

    header {
        border-bottom: 1px solid #eaecef;

        input[type=search] {
            width: 100%
        }
    }
}

.slideout-open #sidebar {
    display: flex;
}

#content {
    background: white;
    position: relative;
    z-index: 1;
    will-change: transform;
    min-height: 100vh;

    .toggle-button{
        border: none;
        font-size: 2em;
        background: white;
        &:focus{
            outline: none;
            background: #eaecef;
        }
    }
}

.pad20{
    padding: 20px;
}

@media screen and (min-width: 780px) {
    #content {
        margin-left: 256px;
    }

    #sidebar {
        display: flex;
    }

    .toggle-button{
        display: none;
    }
}
</style>