<script setup lang="ts">
    import LangButton from '@/Components/LangButton.vue';
    import { LandingPageText } from '@/Props/LandingPageProps';

    interface Props {
        text: LandingPageText;
    }

    const props = defineProps<Props>();

</script>

<template>
    <div class="sticky flex justify-between p-5">
        <h1>LOGO</h1>
        <div class="flex gap-5">
            <p>FEATURE1</p>
            <p>FEATURE2</p>
            <p>FEATURE3</p>
        </div>
        <div class="flex gap-2">
            <button class="btn btn-primary btn-outline">{{ props.text.logIn }}</button>
            <button class="btn btn-primary">{{ props.text.register }}</button>
            <LangButton />
        </div>
    </div>
</template>
