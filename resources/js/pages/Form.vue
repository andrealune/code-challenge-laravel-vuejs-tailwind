<template>
    <div class="w-full">
        <form @submit.prevent="submit">
            <div class="relative" ref="loadingContainer">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-1 sm:col-span-2">
                        <BaseInput
                            type="text"
                            v-model="form.first_name"
                            name="first_name"
                            label="first_name"
                            v-model:error="formErrors.first_name"
                        />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <BaseInput
                            type="text"
                            v-model="form.last_name"
                            name="last_name"
                            label="last_name"
                            v-model:error="formErrors.last_name"
                        />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <BaseInput
                            type="text"
                            v-model="form.email"
                            name="email"
                            label="email"
                            v-model:error="formErrors.email"
                        />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <BaseInput
                            type="text"
                            v-model="form.phone"
                            name="phone"
                            label="phone"
                            v-model:error="formErrors.phone"
                        />
                    </div>
                </div>
            </div>
            <BaseButton class="mt-2" type="submit">{{route.params.id ? 'Update' : 'Save'}}</BaseButton>
        </form>
    </div>
</template>

<script>
export default {
    name: 'ContactForm'
}
</script>

<script setup>
import { onMounted, computed, inject, ref, reactive } from "vue";
import { useRoute, useRouter, onBeforeRouteLeave } from "vue-router";
import { useStore } from "vuex";

const route = useRoute()
const router = useRouter()
const store = useStore()

// const $loading = inject("$loading");

// const loadingContainer = ref(false);

const initForm = {
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
};

const formErrors = computed(() => store.getters["getFormErrors"]);

const form = reactive({ ...initForm });

const submit = async () => {
    // let loader = $loading.show({ container: loadingContainer.value });
    let action = route.params.id ? "update" : "create"
    await store
        .dispatch(action, {
            form,
            id: route.params.id,
        })
        .then((response) => {
            // loader.hide()
            router.push({name: 'ContactList'})
        })
        .catch((e) => {
            // loader.hide()
        });
};

const getItem = async () => {
    // let loader = $loading.show({ container: loadingContainer.value });
    await store.dispatch("get", {
        id: route.params.id
    }).then((response) => {
        // loader.hide()
        Object.assign(form, response?.data);
    }).catch((e) => {
        // loader.hide()
        router.push({name: 'ContactList'})
    });
    // console.log(res);
};

const resetFormErrors = () => {
    store.dispatch("resetFormErrors");
}

onMounted(async () => {
    if (route.params.id) {
        await getItem();
    }
})

onBeforeRouteLeave((to, from) => {
    resetFormErrors()
});
</script>
