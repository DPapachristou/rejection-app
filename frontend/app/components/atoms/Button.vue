<template>
  <div>
    <button 
    :class="['py-2 px-6 rounded-lg shadow hover:bg-green-600 cursor-pointer', isBackButton ? 'bg-orange-400 hover:bg-orange-500' : 'bg-green-500 hover:bg-green-600']"
    @click="handleClick('clicked')"
    >
      <slot />
    </button>
  </div>
</template>

<script setup>

const props = defineProps({
  isBackButton: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['click'])

function handleClick(message) {
  emit('click', message)
}

</script>
