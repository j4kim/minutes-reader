<template>
    <div>
        <small v-for="tag in tags" :key="tag">
            {{ tag }}
        </small>
    </div>
</template>

<script>
export default {
    props: ["tags"]
}
</script>