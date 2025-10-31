<script setup lang="ts">
    import { getCookie, setCookie } from '@/Scripts/Cookie';
    import { router } from '@inertiajs/vue3';
    import { onMounted } from 'vue';

    const selectModel = defineModel<string>();

    onMounted(() => {
        selectModel.value = getDefault();
    });

    function setLang(): void {
        setCookie("lang", selectModel.value);
        router.reload({ only: ["text"] });
    }

    function getDefault(): string {
        return getCookie("lang") || "en_US";
    }
</script>

<template>
    <select v-model="selectModel" @change="setLang">
        <option value="pt_BR">Português</option>
        <option value="en_US">English</option>
    </select>
</template>
