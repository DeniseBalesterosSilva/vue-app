<!-- Components/Toast.vue -->
<template>
  <div v-if="visible" class="toast">
    {{ message }}
  </div>
</template>

<script>
export default {
  props: ['message'],
  data() {
    return { visible: false }
  },
  watch: {
    message(newMessage) {
      if (newMessage) {
        this.visible = true
        setTimeout(() => this.visible = false, 3000) // some efeito de desaparecer
      }
    }
  }
}
</script>

<style scoped>
.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #333;
  color: #fff;
  padding: 12px 20px;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
</style>
