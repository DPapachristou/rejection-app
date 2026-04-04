<template>
  <div>
    <button 
    :class="['py-2 px-6 rounded-lg shadow cursor-pointer', 
    isBackButton 
    ? 'bg-transparent border border-[rgba(212,168,83,0.2)] text-white/50 hover:text-white/80 hover:border-[rgba(212,168,83,0.4)] hover:bg-white/[0.03]' 
    : 'bg-[rgba(214,170,83,0.8)] hover:bg-[rgba(212,168,83,0.5)]',
    disabled 
    ? 'opacity-50 cursor-not-allowed' 
    : ''
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
