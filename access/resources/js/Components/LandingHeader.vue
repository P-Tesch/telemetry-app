<script setup lang="ts">
    import LoginPageView from '@/actions/App/Views/Auth/Login/LoginPageView';
import RegisterPageView from '@/actions/App/Views/Auth/Register/RegisterPageView';
import LandingPageView from '@/actions/App/Views/LandingPage/LandingPageView';
import LangButton from '@/Components/LangButton.vue';
    import { LandingPageText } from '@/Props/LandingPageProps';
    import { Link } from '@inertiajs/vue3';

    interface Props {
        text: LandingPageText;
    }

    const props = defineProps<Props>();

</script>

<template>
    <div class="sticky flex justify-between p-5">
        <Link :href="LandingPageView()">LOGO</Link>
        <div class="flex gap-5">
            <p>FEATURE1</p>
            <p>FEATURE2</p>
            <p>FEATURE3</p>
        </div>
        <div class="flex gap-2">
            <Link class="btn btn-primary btn-outline" :href="LoginPageView()">{{ props.text.logIn }}</Link>
            <Link class="btn btn-primary" :href="RegisterPageView()">{{ props.text.register }}</Link>
            <LangButton />
        </div>
    </div>
</template>
