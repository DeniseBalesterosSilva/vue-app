<template>
  <div>
    <label :for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
      {{ label }}
    </label>
    <input
      :type="type"
      :id="id"
      :placeholder="placeholder"
      :required="required"
      :class="cellClass"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>

<script>
  export default {
    name: 'BaseInput',
    props: {
      label: String,
      type: {
        type: String,
        default: 'text'
      },
      id: String,
      placeholder: String,
      required: {
        type: Boolean,
        default: false
      },
      modelValue: String,
      class: {
        type: String,
        default: ''
      }
    },

    computed: {
      cellClass() {
        return `bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ${this.class}`.trim();
      },
    }
  }
</script>
