<script setup lang="ts">
    import LoginPageProps from '@/Props/LoginPageProps';
    import login from '@/routes/login';
    import { Form } from '@inertiajs/vue3';

    const props = defineProps<LoginPageProps>();
</script>

<template>
    <div class="flex">
        <Form :action="login.store()">
            <div class="flex">
                <label for="username">{{ props.text.name }}</label>
                <input name="username" class="input"></input>
            </div>
            <div class="flex">
                <label for="password">{{ props.text.password }}</label>
                <input name="password" type="password" class="input"></input>
            </div>
            <button type="submit" class="btn">{{ props.text.logIn }}</button>
        </Form>
    </div>
</template>
