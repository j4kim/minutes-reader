<template>
    <router-link :to="page.name">{{ page.title }}</router-link>
</template>

<script>
export default {
    props: ["page"]
}
</script>