<script setup lang="ts">
import LoginView from '@/actions/App/Views/Auth/Login/LoginView';
import LoginProps from '@/Props/LoginProps';
import { Form } from '@inertiajs/vue3';

const props = defineProps<LoginProps>();
</script>

<template>
    <div class="flex">
        <Form :action="LoginView.login()">
            <div class="flex">
                <label for="name">{{ props.text.name }}</label>
                <input name="name" class="input"></input>
            </div>
            <div class="flex">
                <label for="password">{{ props.text.password }}</label>
                <input name="password" type="password" class="input"></input>
            </div>
            <button type="submit" class="btn">{{ props.text.logIn }}</button>
        </Form>
    </div>
</template>
