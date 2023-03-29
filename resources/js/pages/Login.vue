<template>
    <div class="md:w-4/5 mx-auto">
        <div>
            <div>
                <div>
                    <div>
                        <h1 class="text-center text-xl my-4">Login</h1>
                        <hr class="mb-4" />
                        <form
                            action="javascript:void(0)"
                            method="post"
                            class="flex flex-col gap-4"
                        >
                            <div
                                v-if="Object.keys(validationErrors).length > 0"
                            >
                                <div class="p-4 bg-red-500 text-white">
                                    <ul class="mb-0">
                                        <li
                                            v-for="(
                                                value, key
                                            ) in validationErrors"
                                            :key="key"
                                        >
                                            {{ value[0] }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    v-model="auth.email"
                                    name="email"
                                    id="email"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div>
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    v-model="auth.password"
                                    name="password"
                                    id="password"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    @click="login"
                                    class="bg-indigo-500 rounded-md hover:bg-indigo-600 px-4 py-2 text-white"
                                >
                                    {{ processing ? "Please wait" : "Login" }}
                                </button>
                            </div>
                            <div class="text-center">
                                <label
                                    >Don't have an account?
                                    <router-link :to="{ name: 'register' }"
                                        >Register Now!</router-link
                                    ></label
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const auth = ref({ email: "", password: "" });
const validationErrors = ref({});
const processing = ref(false);

const login = async () => {
    processing.value = true;
    await axios.get("/sanctum/csrf-cookie");
    await axios
        .post("/login", auth.value)
        .then(({ data }) => {
            router.push("/");
        })
        .catch(({ response }) => {
            if (response.status === 422) {
                validationErrors.value = response.data.errors;
            } else {
                validationErrors.value = {};
            }
        })
        .finally(() => {
            processing.value = false;
        });
};
</script>
