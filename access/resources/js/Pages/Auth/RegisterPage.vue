<script setup lang="ts">
    import RegisteredUserController from '@/actions/Laravel/Fortify/Http/Controllers/RegisteredUserController';
    import RegisterPageProps from '@/Props/RegisterPageProps';
    import { Form } from '@inertiajs/vue3'

    const props = defineProps<RegisterPageProps>();
</script>

<template>
    <div class="outline p-10 flex">
        <Form :action="RegisteredUserController.store()">
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
