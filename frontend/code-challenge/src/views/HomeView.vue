<template>
  <div class="home static">
    <AppNavBarVue></AppNavBarVue>

    <div class="container mx-auto mt-5 flex justify-end">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        @click="showModal = true; modalTitle= 'New Contact'"
      >
        Add new contact
      </button>
    </div>

    <t-alert :variant="alertVariant" :show="showAlert" :timeout="1000">
      {{textAlert}}
    </t-alert>

    <div class="container mx-auto">
      <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                  <tr>
                    <th
                      v-for="(field, index) in fields"
                      :key="index"
                      scope="col"
                      class="px-6 py-4"
                    >
                      {{ field.label }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600"
                    v-for="contact in contacts"
                    :key="contact.id"
                  >
                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                      {{ contact.id }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                      {{ contact.first_name }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                      {{ contact.last_name }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                      {{ contact.phone }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                      {{ contact.email }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 flex justify-between">

                      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="getContactInformation(contact.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0a58ca" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                      </button>

                      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="openUpdateModal(contact)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0a58ca" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                          <path d="M16 5l3 3" />
                        </svg>
                      </button>

                      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="deleteContact(contact.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0a58ca" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M4 7l16 0" />
                          <path d="M10 11l0 6" />
                          <path d="M14 11l0 6" />
                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                      </button>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <t-modal v-model="showModal" @before-close="closeModal()" :header="modalTitle">
      <form>
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
              Contact Information
            </h2>
            <p v-if="!viewContactInfo" class="mt-1 text-sm leading-6 text-gray-600">
              Add the required fields marked with
              <span class="text-red-700">*.</span>
            </p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-6">
                <label
                  for="first-name"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >First name <span class="text-red-700">*</span></label
                >
                <div class="mt-2">
                  <input
                    type="text"
                    name="first-name"
                    id="first-name"
                    autocomplete="given-name"
                    v-model="newContact.first_name"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>

              <div class="sm:col-span-6">
                <label
                  for="last-name"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Last name <span class="text-red-700">*</span></label
                >
                <div class="mt-2">
                  <input
                    type="text"
                    name="last-name"
                    id="last-name"
                    autocomplete="family-name"
                    v-model="newContact.last_name"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>

              <div class="sm:col-span-6">
                <label
                  for="email"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Email address</label
                >
                <div class="mt-2">
                  <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    v-model="newContact.email"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>

              <div class="col-span-full">
                <label
                  for="phonenumber"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Phone number</label
                >
                <div class="mt-2">
                  <input
                    type="tel"
                    id="phonenumber"
                    v-model="newContact.phone"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <template v-if="!viewContactInfo" v-slot:footer>
        <div class="flex justify-end">
          <button
            type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            @click="addNewContact()"
            v-if="!update"
          >
            Save
          </button>
          <button
            v-else
            type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            @click="updateContact()"
          >
            Update
          </button>
        </div>
      </template>
    </t-modal>

  </div>
</template>

<script>
// @ is an alias to /src
import AppNavBarVue from "@/components/layout/AppNavBar.vue";

export default {
  name: "HomeView",
  components: {
    AppNavBarVue,
  },
  data() {
    return {
      showModal: false,
      showAlert: false,
      viewContactInfo: false,
      modalTitle: '',
      update: false,
      textAlert: '',
      alertVariant: 'success',
      fields: [
        { label: "id" },
        { label: "First Name" },
        { label: "Last Name" },
        { label: "Phone" },
        { label: "Email" },
        { label: "Actions"}
      ],
      contacts: [],

      newContact: {
        id: "",
        first_name: "",
        last_name: '',
        phone: '',
        email: ''
      }
    };
  },
  mounted() {
    this.getContacts();
  },
  methods: {
    getContacts() {
      this.$axios
        .get("contact/index")
        .then((resp) => {
          this.contacts = resp.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addNewContact(){
      this.showAlert = false;
      this.alertVariant = 'success'
      this.$axios.post('contact/store', this.newContact)
      .then( resp => {
        if(!resp.data.ok) return;
        this.textAlert = resp.data.message
        this.showAlert = true;
        this.showModal = false;
        this.getContacts();
      })
      .catch( err => {
        console.log(err)
      })
    },

    getContactInformation(id){
      this.$axios.get(`contact/show/${id}`)
      .then(resp => {
        this.modalTitle = 'Contact information'
        this.viewContactInfo = true;
        this.newContact = resp.data.data;
        this.showModal = true;
      }).catch(err => console.log(err))
    },

    openUpdateModal(data){
      this.newContact = {...data};
      this.update = true;
      this.showModal = true;

    },

    updateContact(){
      this.showAlert = false;
      this.alertVariant = 'success'
      this.$axios.put(`contact/update/${this.newContact.id}`, this.newContact)
      .then( resp => {
        if (!resp.data.ok) return;
        this.textAlert = resp.data.message
        this.showModal = false;
        this.showAlert = true;
        this.getContacts()
      })
      .catch( err => {
        console.log(err)
      })
    },

    deleteContact(id){
      this.showAlert = false;
      this.variant = null;
      this.$axios.delete(`contact/delete/${id}`)
      .then( resp => {
        if (!resp.data.ok) return;
        this.textAlert = resp.data.message
        this.alertVariant = 'success'
        this.showAlert = true;
        this.getContacts()
      })
      .catch( err => {
        this.alertVariant = 'danger'
        this.textAlert = err.response.data.message
        this.showAlert = true;
        console.log(err.response.data.message)
      })
    },

    closeModal(){
      this.newContact.first_name = ''
      this.newContact.last_name = ''
      this.newContact.phone = ''
      this.newContact.email = ''
      this.viewContactInfo = false
      this.modalTitle = '';
      this.update = false;
    }
  },
};
</script>
