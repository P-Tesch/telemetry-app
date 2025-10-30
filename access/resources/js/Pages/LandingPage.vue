<script setup lang="ts">

interface Props {
    message: string
}

const props = defineProps<Props>();
</script>

<template>
    <h1>{{ props.message }}</h1>
</template>
