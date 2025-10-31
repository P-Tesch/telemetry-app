<script setup lang="ts">
import LandingHeader from '@/Components/LandingHeader.vue';
import LandingPageProps from '@/Props/LandingPageProps';

const props = defineProps<LandingPageProps>();
</script>

<template>
    <LandingHeader :text="props.text" />
    <h1>{{ props.message }}</h1>
</template>
