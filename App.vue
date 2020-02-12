<template>
    <div id="app" class="markdown-body">
        <nav id="sidebar">
            <ul v-if="pages.length">
                <li v-for="page in pages" :key="page.name">
                    <router-link :to="page.name">{{ page.title }}</router-link>
                </li>
            </ul>
        </nav>
        <div id="content">
            <div :style="{textAlign:'right',padding:'10px', marginBottom:'-20px'}">
                <a
                    v-if="$route.params.page"
                    :href="$root.editLinkBase + $route.params.page"
                    target="_blank"
                >Editer</a>
            </div>
            <router-view />
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return { pages: [] }
    },
    created(){
        fetch("get_content.php")
            .then(response => response.json())
            .then(json => this.pages = json)
    }
}
</script>

<style>
body,html{
    margin:0;
    padding:0;
}
#app{
    display: flex;
}
#app > *{
    height: 100vh;
    overflow: auto;
}
#sidebar{
    padding: 20px;
    width: 600px;
    min-width: 200px;
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
#sidebar ul li a.router-link-active{
    color: black;
}
#content{
    width: 100%;
    min-width: 500px;
}
</style>