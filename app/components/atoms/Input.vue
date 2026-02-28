<template>
    <select 
      v-if="type === 'dropdown' || type === 'select'"
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
      class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 text-gray-900 shadow-sm"
    >
      <option value="" disabled selected class="text-gray-900">{{ placeholder }}</option>
      <option v-for="opt in option" :key="opt" :value="opt">
        {{ opt }}
      </option>
    </select>

    <textarea 
      v-else-if="type === 'textarea'"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 shadow-sm text-gray-900"
    ></textarea>

    <input 
      v-else
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 text-gray-900 shadow-sm"
    />
</template>

<script setup>

defineProps({
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
  }
});

</script>