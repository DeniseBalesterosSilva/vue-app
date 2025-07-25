<template>
  <component
    :is="tag"
    :class="computedClass"
    @click="sortBy"
    class="cursor-pointer select-none"
  >
    <div class="flex items-center gap-1">
      <slot />
      <!-- arrow icons -->
      <span v-if="isActive">
        <i v-if="direction === 'asc'" class="fas fa-chevron-up text-white"></i>
        <i v-else class="fas fa-chevron-down text-white"></i>
        </span>
    </div>
  </component>
</template>

<script>
import { router as Inertia } from '@inertiajs/vue3';

export default {
  props: {
    tag: {
      type: String,
      default: 'th'
    },
    column: {
      type: String,
      required: true
    },
    routeName: {
      type: String,
      required: true
    },
    sortColumn: {
      type: String,
      default: ''
    },
    sortDirection: {
      type: String,
      default: 'asc'
    },
    class: {
      type: String,
      default: ''
    }
  },
  computed: {
    isActive() {
      return this.sortColumn === this.column
    },
    direction() {
      return this.isActive ? this.sortDirection : 'asc'
    },
    computedClass() {
      const base = 'px-4 py-1 font-semibold'
      const active = this.isActive ? 'font-bold' : ''
      return `${base} ${active} ${this.class}`.trim()
    }
  },
  methods: {
    sortBy() {
      const nextDirection = this.isActive && this.sortDirection === 'asc' ? 'desc' : 'asc'
      this.route && Inertia.visit(this.route(this.routeName, {
        sortBy: this.column,
        sortDir: nextDirection
      }), {
        preserveScroll: true
      })
    }
  }
}
</script>
