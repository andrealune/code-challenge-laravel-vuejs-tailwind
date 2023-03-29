<template>
    <div class="w-full md:max-w-7xl md:mx-auto flex justify-between mb-4">
        <div></div>
        <BaseButton @click="router.push({name: 'ContactList'})">List All Contacts</BaseButton>
    </div>

    <BaseCard class="p-6">
        <ContactForm></ContactForm>
    </BaseCard>
</template>

<script>
export default {
    name: 'ContactAction'
}
</script>

<script setup>
import { useRouter } from "vue-router";
import ContactForm from "./Form.vue";

const router = useRouter();
</script>
