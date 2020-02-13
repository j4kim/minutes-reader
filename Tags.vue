<template>
    <div>
        <small
            v-for="tag in tags"
            :key="tag.id"
            :class="'tag tag-'+tag.id" 
        >
            {{ tag.name }}
        </small>
    </div>
</template>

<script>
export default {
    props: ["tags"]
}
</script>

<style>
    .tag {
        background: lightgrey;
        padding: 1px 4px;
        margin: 2px;
        border: 1px solid white;
        border-radius: 4px;
        font-size: .75em;
    }
    .tag-0 { background: darkkhaki }
    .tag-5 { background: palevioletred }
    .tag-1 { background: greenyellow }
    .tag-3 { background: aquamarine }
    .tag-2 { background: burlywood }
    .tag-4 { background: cadetblue }
    .tag-7 { background: plum }
    .tag-6 { background: palegreen }
    .tag-8 { background: pink }
</style>