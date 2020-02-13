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
        background: #f5f5f5;
        padding: 1px 4px;
        margin: 2px;
        border: 1px solid white;
        border-radius: 4px;
        font-size: .75em;
    }
    .tag-0 { background: #ffcdd2 }
    .tag-1 { background: #f8bbd0 }
    .tag-2 { background: #e1bee7 }
    .tag-3 { background: #d1c4e9 }
    .tag-4 { background: #c5cae9 }
    .tag-5 { background: #bbdefb }
    .tag-6 { background: #b3e5fc }
    .tag-7 { background: #b2ebf2 }
    .tag-8 { background: #b2dfdb }
    .tag-9 { background: #c8e6c9 }
    .tag-10{ background: #dcedc8 }
    .tag-11{ background: #f0f4c3 }
    .tag-12{ background: #fff9c4 }
    .tag-13{ background: #ffecb3 }
    .tag-14{ background: #ffe0b2 }
    .tag-15{ background: #ffe0b2 }
    .tag-16{ background: #d7ccc8 }
</style>