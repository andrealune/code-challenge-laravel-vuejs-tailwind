<template>
  <div>
    <!-- Modal -->
    <div v-if="userModal" class="fixed z-10 inset-0 overflow-y-auto">
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full h-auto"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add Entry</h3>
                <div class="sm:flex sm:flex-wrap sm:justify-between">
                  <div class="mb-4 w-full sm:w-5/12">
                    <label class="block text-gray-700 font-bold mb-2" for="first-name">
                      First Name
                    </label>
                    <input
                      v-model="firstName"
                      class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="first-name"
                      type="text"
                      placeholder="Enter first name"
                    />
                    <div v-if="validation.firstName" class="mt-2 text-xs text-red-500">
                      This field is required
                    </div>
                  </div>
                  <div class="mb-4 w-full sm:w-5/12 sm:ml-4">
                    <label class="block text-gray-700 font-bold mb-2" for="last-name">
                      Last Name
                    </label>
                    <input
                      v-model="lastName"
                      class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="last-name"
                      type="text"
                      placeholder="Enter last name"
                    />
                    <div v-if="validation.lastName" class="mt-2 text-xs text-red-500">
                      This field is required
                    </div>
                  </div>
                  <div class="mb-4 w-full sm:w-5/12 sm:ml-1">
                    <label class="block text-gray-700 font-bold mb-2" for="last-name">
                      Email
                    </label>
                    <input
                      v-model="email"
                      class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="last-name"
                      type="text"
                      placeholder="Enter last name"
                    />
                  </div>
                  <div class="mb-4 w-full sm:w-5/12 sm:ml-4">
                    <label class="block text-gray-700 font-bold mb-2" for="last-name">
                      Phone
                    </label>
                    <input
                      v-model="phone"
                      class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="last-name"
                      type="text"
                      placeholder="Enter last name"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              @click="onSubmit"
              type="button"
              class="rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Submit
            </button>
            <button
              @click="onClose(null)"
              type="button"
              class="mt-3 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import userService from '../service/usersService'

export default {
  name: 'upsertUserModal',
  data() {
    return {
      firstName: null,
      lastName: null,
      email: null,
      phone: null,
      validation: {
        firstName: false,
        lastName: false,
      },
    }
  },
  props: {
    userModal: {
      type: Boolean,
    },

    editItem: {
      type: Object,
    },
  },
  methods: {
    async onSubmit() {
      this.resetValidation()
      this.checkValidation()

      if (this.firstName && this.lastName) {
        if (!this.editItem) {
          // * create new record
          const payload = {
            first_name: this.firstName,
            last_name: this.lastName,
            email: this.email,
            phone: this.phone,
          }

          const data = await userService.addUser(payload)
          this.onClose(data)
        } else {
          // * update existing record
          const payload = {
            first_name: this.firstName,
            last_name: this.lastName,
            email: this.email,
            phone: this.phone,
          }

          const data = await userService.editUser(this.editItem.id, payload)
          this.onClose(data)
        }
      }
    },

    onClose(response) {
      this.firstName = null
      this.lastName = null
      this.email = null
      this.phone = null
      this.resetValidation()

      this.$emit('onClose', response)
    },
    checkValidation() {
      if (!this.firstName) this.validation.firstName = true
      if (!this.lastName) this.validation.lastName = true
    },
    resetValidation() {
      this.validation.firstName = false
      this.validation.lastName = false
    },
  },

  watch: {
    value: {
      immediate: true,
      handler() {
        if (this.editItem) {
          const { first_name, last_name, phone, email } = this.editItem
          this.firstName = first_name
          this.lastName = last_name
          this.email = email
          this.phone = phone
        }
      },
    },
  },
}
</script>
<style scoped></style>
