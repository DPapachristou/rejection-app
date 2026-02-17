<template>
  <div>
    <button 
    class="bg-green-500 py-2 px-6 rounded-lg shadow"
    @click="handleClick('clicked')"
    >
      <slot />
    </button>
  </div>
</template>

<script setup>
const emit = defineEmits(['click'])

function handleClick(message) {
  emit('click', message)
}

</script>
