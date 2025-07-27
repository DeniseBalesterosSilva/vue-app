<template>
  <div>
    <label v-if="label" :for="id" class="text-sm font-medium text-gray-900 dark:text-gray-300">
      {{ label }}
    </label>

    <select
      v-model="selected"
      :id="id"
      :class="computedClass"
      class="w-full p-2.5"
    >
      <option v-if="allOption" value="">Todos</option>

      <option v-for="option in options" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>

    <span v-if="error" class="text-red-500 text-xs mt-3 block">
      {{ error }}
    </span>
  </div>
</template>

<script>
export default {
  props: {
    label: String,
    options: {
      type: Array,
      required: true
    },
    routeName: {
      type: String,
      required: false
    },
    id: String,
    modelValue:[String, Number],
    allOption: Boolean,
    emptyOption: Boolean,
    error: String,
    class: {
      type: String,
      default: ''
    }
  },
  emits: ['update:modelValue'],
  computed: {
    selected: {
        get() {
          return this.modelValue
        },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    },
    computedClass() {
      const base =
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white'
      return `${base} ${this.class}`.trim()
    }
  },
}
</script>
