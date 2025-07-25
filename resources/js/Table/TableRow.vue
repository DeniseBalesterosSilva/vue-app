<template>
  <tr :class="rowClass">
    <slot />
  </tr>
</template>

<script>
export default {
  props: {
    rowClass: {
      type: String,
      default: 'border-b border-gray-200 dark:border-gray-700 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600'
    }
  }
}
</script>
