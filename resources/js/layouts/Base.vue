<script setup></script>

<template>
    <main class="flex flex-col h-screen">
        <div class="px-12 py-6 bg-gray-300 text-3xl font-bold">
            <RouterLink to="/contacts">Contacts</RouterLink>
        </div>
        <div class="flex-auto overflow-y-auto overflow-x-hidden">
            <router-view></router-view>
        </div>
    </main>
</template>
