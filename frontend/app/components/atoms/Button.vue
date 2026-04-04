<template>
  <div>
    <button 
    :class="['py-2 px-6 rounded-lg shadow cursor-pointer', 
    isBackButton ? 'bg-orange-400 hover:bg-orange-500' : 'bg-[rgba(214,170,83,0.8)] hover:bg-[rgba(212,168,83,0.25)]',
    disabled ? 'opacity-50 cursor-not-allowed' : ''
    ]"
    @click="handleClick('clicked')"
    :disabled="disabled"
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
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['click'])

const handleClick = (message) => {
  if (!props.disabled) {
  emit('click', message)
  }
}

</script>
