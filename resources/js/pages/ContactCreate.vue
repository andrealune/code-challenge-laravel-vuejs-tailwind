<template>
    <div class="px-16 md:px-24 mt-5">
        <div class="flex justify-end my-4">
            <RouterLink
                to="/contacts"
                class="bg-green-500 rounded-md hover:bg-green-600 px-4 py-2 text-white"
            >
                To list
            </RouterLink>
        </div>
        <div class="flex flex-col gap-12">
            <div>
                <div>
                    <label>First name</label>
                </div>
                <input
                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                    name="first_name"
                    :value="contact.first_name"
                    @input="handleChange"
                />
            </div>
            <div>
                <div>
                    <label>Last name</label>
                </div>
                <input
                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                    name="last_name"
                    :value="contact.last_name"
                    @input="handleChange"
                />
            </div>
            <div>
                <div>
                    <label>Phone</label>
                </div>
                <input
                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                    name="phone"
                    :value="contact.phone"
                    @input="handleChange"
                />
            </div>
            <div>
                <div>
                    <label>Email</label>
                </div>
                <input
                    class="rounded-md border border-gray-400 py-2 px-4 w-full"
                    name="email"
                    :value="contact.email"
                    @input="handleChange"
                />
            </div>
            <div>
                <button
                    to="contacts"
                    class="bg-indigo-500 rounded-md hover:bg-indigo-600 px-4 py-2 text-white"
                    @click="handleSave"
                >
                    Save
                </button>
            </div>
            <div v-if="message" class="bg-green-400 p-5 text-white">
                {{ message }}
            </div>
            <div v-if="errMessage" class="bg-red-400 p-5 text-white">
                {{ errMessage }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const message = ref("");
const contact = ref({
    first_name: "",
    last_name: "",
    phone: null,
    email: null,
});
const id = route.params.id;

const handleChange = ({ target: { name, value } }) => {
    message.value = "";
    errMessage.value = "";

    contact.value = {
        ...contact.value,
        [name]: value,
    };
};

const handleSave = () => {
    if (id) {
        axios
            .patch(`/api/contacts/${id}`, contact.value)
            .then(() => {
                message.value = "Successfully updated";
            })
            .catch(() => {
                errMessage.value = "Something went wrong";
            });
    } else {
        axios
            .post("/api/contacts", contact.value)
            .then(() => {
                contact.value = {};
                message.value = "Successfully created";
            })
            .catch(() => {
                errMessage.value = "Something went wrong";
            });
    }
};

onMounted(async () => {
    if (id) {
        contact.value = (await axios.get(`/api/contacts/${id}`)).data;
    }
});
</script>
