<template>
    <select 
      v-if="type === 'dropdown' || type === 'select'"
      @change="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      :value="modelValue"
      :class="[
        'bg-gray-50 border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 text-gray-900 shadow-sm',
         error 
            ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-200' 
            : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 bg-white'
         ]"
    >
      <option 
      value="" 
      disabled class="text-gray-900"
      >
      {{ placeholder }}
      </option>
      <option v-for="opt in option" :key="opt" :value="opt">
        {{ opt }}
      </option>
    </select>

    <textarea 
      v-else-if="type === 'textarea'"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      :value="modelValue"
      :class="['bg-gray-50 border text-sm rounded-lg block w-full p-2.5 shadow-sm text-gray-900 h-full h-max-110', error 
            ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-200' 
            : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 bg-white'
      ]"
    ></textarea>

    <input 
      v-else
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      :class="['bg-gray-50 border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 text-gray-900 shadow-sm', error 
            ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-200' 
            : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 bg-white'
      ]"
    />
</template>

<script setup>

const props = defineProps({
  placeholder: {
    type: String,
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  option: {
    type: Array,
    default: () => []
  },
  modelValue: {
    type: [String, Number],
    default: ''
  },
  error: {
    type: Object,
    default: {}
  }
});

</script>