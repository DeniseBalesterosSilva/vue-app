<template>
  <component :is="tag" :class="cellClass">
    <slot />
  </component>
</template>

<script>
export default {
  props: {
    tag: {
      type: String,
      default: 'td' // ou 'th'
    },
    class: {
      type: String,
      default: ''
    }
  },
  computed: {
    cellClass() {
      return `px-4 py-1 ${this.class}`.trim();
    },
  },
}
</script>
