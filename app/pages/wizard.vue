<template>
  <div class="bg-brand-gray text-white py-10 px-10 text-center gap-5 flex flex-col items-center">
  <h3 class="text-4xl text-white">Role Context</h3>
  <span class="text-xl text-white/40">What role were you interviewed for?</span>
  </div>
  <div class="w-full px-10 pb-30 items-center flex flex-col gap-5">
    <img src="/icons/Tooltip.svg" alt="Quote-Logo" class="w-25 h-25" />
    <div class="w-2/4 bg-gray-200 rounded-full dark:bg-white/20">
      <div class="bg-green-600 h-2.5 rounded-full" style="width: 20%"></div>
    </div>
    <div class="w-1/4 py-5">
      <label for="visitors" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
         Role Title
      </label>
      <input type="text" id="visitors" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white shadow-sm" 
        placeholder="Enter Role Title" required />
    </div>
    

    
  </div>
</template>