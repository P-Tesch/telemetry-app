<script setup lang="ts">
import LangButton from '@/Components/LangButton.vue';
import LandingPageProps from '@/Props/LandingPageProps';

const props = defineProps<LandingPageProps>();
</script>

<template>
    <h1>{{ props.message }}</h1>
    <button>{{ props.text.logIn }}</button>
    <button>{{ props.text.register }}</button>
    <LangButton />
</template>
