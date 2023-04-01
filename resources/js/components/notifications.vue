<template>
  <div
    v-if="visible"
    class="fixed top-3 bg-green-100 border-green-400 text-green-700 border-l-4 p-4 mt-4"
  >
    <div class="flex items-center justify-center">
      <div class="text-green-500 mr-2">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="check-circle w-6 h-6">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 13l4 4L19 7"
          ></path>
        </svg>
      </div>
      <span class="text-gray-700">
        <slot></slot>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    visible: Boolean,
  },
}
</script>
