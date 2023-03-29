<template>
    <div class="px-16 md:px-24 mt-5">
        <div class="flex justify-end my-4">
            <RouterLink
                to="contacts/create"
                class="bg-green-500 rounded-md hover:bg-green-600 px-4 py-2 text-white"
            >
                Create
            </RouterLink>
        </div>
        <div v-if="errMessage" class="bg-red-400 p-5 text-white mb-4">
            {{ errMessage }}
        </div>
        <div v-if="message" class="bg-green-400 p-5 text-white mb-4">
            {{ message }}
        </div>
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th class="px-6 py-4">First Name</th>
                    <th class="px-6 py-4">Last Name</th>
                    <th class="px-6 py-4">Phone</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="contact in contacts"
                    :key="contact.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="px-6 py-4">
                        {{ contact.first_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ contact.last_name }}
                    </td>
                    <td class="px-6 py-4">{{ contact.phone }}</td>
                    <td class="px-6 py-4">{{ contact.email }}</td>
                    <td class="px-6 py-4 flex gap-4 justify-end">
                        <RouterLink
                            :to="`/contacts/${contact.id}/edit`"
                            class="bg-indigo-500 rounded-md hover:bg-indigo-600 px-4 py-2 text-white"
                        >
                            Edit
                        </RouterLink>
                        <button
                            class="bg-yellow-400 rounded-md hover:bg-yellow-500 px-4 py-2 text-white"
                            :id="contact.id"
                            @click="handleDelete"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
                <tr
                    v-if="!contacts.length"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td colspan="5" class="px-6 py-4 text-center">No data</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const contacts = ref([]);
const errMessage = ref("");
const message = ref("");

const handleDelete = ({ target: { id } }) => {
    message.value = "";
    axios
        .delete(`api/contacts/${id}`)
        .then(({ data }) => {
            const deletedContact = data;
            errMessage.value = "";
            message.value = "Successfully deleted";

            contacts.value = contacts.value.filter(
                (contact) => contact.id !== deletedContact.id
            );
        })
        .catch(() => {
            errMessage.value = "Only admin can delete";
            message.value = "";
        });
};

onMounted(async () => {
    contacts.value = (await axios.get("api/contacts")).data;
});
</script>
