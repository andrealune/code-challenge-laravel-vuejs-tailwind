<template>
    <div class="md:w-4/5 mx-auto">
        <div>
            <div>
                <div>
                    <div>
                        <h1 class="text-center text-xl my-4">Register</h1>
                        <hr />
                        <form
                            action="javascript:void(0)"
                            @submit="register"
                            method="post"
                            class="flex flex-col gap-4"
                        >
                            <div
                                v-if="Object.keys(validationErrors).length > 0"
                            >
                                <div class="p-4 text-white bg-red-500">
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
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    v-model="user.name"
                                    id="name"
                                    placeholder="Enter name"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    name="email"
                                    v-model="user.email"
                                    id="email"
                                    placeholder="Enter Email"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div>
                                <label for="role">Role</label>
                                <select
                                    type="text"
                                    name="role"
                                    v-model="user.role"
                                    id="role"
                                    placeholder="Select Role"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                >
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div>
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    v-model="user.password"
                                    id="password"
                                    placeholder="Enter Password"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    >Confirm Password</label
                                >
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    v-model="user.password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Enter Password"
                                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                                />
                            </div>
                            <div class="mb-2">
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="bg-indigo-500 rounded-md hover:bg-indigo-600 px-4 py-2 text-white"
                                >
                                    {{
                                        processing ? "Please wait" : "Register"
                                    }}
                                </button>
                            </div>
                            <div class="text-center">
                                <label
                                    >Already have an account?
                                    <router-link :to="{ name: 'login' }"
                                        >Login Now!</router-link
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
const user = ref({
    name: "",
    email: "",
    role: "",
    password: "",
    password_confirmation: "",
});
const validationErrors = ref({});
const processing = ref(false);

const register = async () => {
    processing.value = true;
    await axios.get("/sanctum/csrf-cookie");
    await axios
        .post("/register", user.value)
        .then(() => {
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
