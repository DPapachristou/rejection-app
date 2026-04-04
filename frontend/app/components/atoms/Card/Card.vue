<template>
  <div
    :class="[
      'relative overflow-hidden backdrop-blur-xl transition-all duration-300',
      'bg-white/[0.03] border border-[rgba(212,168,83,0.12)] rounded-[20px]',
      sizeClasses,
      glow && 'border-[rgba(212,168,83,0.25)] shadow-[0_0_40px_rgba(212,168,83,0.06)] hover:border-[rgba(212,168,83,0.35)] hover:shadow-[0_0_50px_rgba(212,168,83,0.1)]',
      style.card,
    ]"  
  >
    <slot />
  </div>
</template>
 
<script setup>
import style from './Card.module.scss';

const props = defineProps({
  size: {
    type: String,
    default: 'md',
    validator: (val) => ['sm', 'md', 'lg', 'full'].includes(val),
  },
  glow: {
    type: Boolean,
    default: false,
  },
});
 
const sizeMap = {
  sm: 'p-5 rounded-[14px]',
  md: 'p-9',
  lg: 'p-12',
  full: 'p-9 w-full',
};
 
const sizeClasses = computed(() => sizeMap[props.size]);
</script>