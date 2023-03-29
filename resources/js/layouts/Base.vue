<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const user = ref(null);
const logout = async () => {
    await axios.post("/logout").then(({ data }) => {
        router.push({ name: "login" });
    });
};

onMounted(() => {
    axios
        .get("/api/user")
        .then(({ data }) => {
            user.value = data;
        })
        .catch(() => {
            router.push("/login");
        });
});
</script>

<template>
    <main class="flex flex-col h-screen">
        <div
            class="px-12 py-6 bg-gray-300 text-3xl font-bold flex justify-between"
        >
            <RouterLink to="/contacts">Contacts</RouterLink>
            <div class="flex gap-4 items-center">
                <span
                    class="text-base text-gray-800"
                    href="#"
                    v-if="user"
                    id="navbarDropdownMenuLink"
                >
                    {{ user.name }} | {{ user.email }}
                </span>
                <a
                    class="text-sm text-red-500"
                    href="javascript:void(0)"
                    @click="logout"
                >
                    Logout
                </a>
            </div>
        </div>
        <div class="flex-auto overflow-y-auto overflow-x-hidden">
            <router-view></router-view>
        </div>
    </main>
</template>
