<template>
    <div>
        <small
            v-for="tag in tags"
            :key="tag.id"
            :class="'tag-'+tag.id" 
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