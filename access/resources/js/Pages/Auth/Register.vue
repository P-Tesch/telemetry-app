<script setup lang="ts">
import RegisterView from '@/actions/App/Views/Auth/Register/RegisterView';
import RegisterProps from '@/Props/RegisterProps';
import { Form } from '@inertiajs/vue3'

const props = defineProps<RegisterProps>();
</script>

<template>
    <div class="outline p-10 flex">
        <Form :action="RegisterView.register()">
            <div class="flex">
                <label for="name">{{ props.text.name }}</label>
                <input name="name" class="input"></input>
            </div>
            <div class="flex">
                <label for="email">{{ props.text.email }}</label>
                <input name="email" class="input"></input>
            </div>
            <div class="flex">
                <label for="password">{{ props.text.password }}</label>
                <input name="password" type="password" class="input"></input>
            </div>
            <div class="flex">
                <label for="password_confirmation">{{ props.text.confirmation }}</label>
                <input name="password_confirmation" type="password" class="input"></input>
            </div>
            <button type="submit" class="btn">{{ props.text.register }}</button>
        </Form>
    </div>
</template>
