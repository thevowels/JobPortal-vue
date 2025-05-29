<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: [String, Number],
    required: true,
});
const emit = defineEmits(['submit'])

defineProps({
    placeholder:{
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'text',
    }
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

</script>

<template >
    <div class="relative border-none">
        <button
            v-if="model"
            @click =" () => {model=''; emit('submit')}"
            type="button"
            class="absolute top-0 right-4 flex h-full items-center pr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <input
            class="rounded-md w-full pr-8 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
            v-model="model"
            :placeholder="placeholder"
            :type="type"
            ref="input"
        />

    </div>


</template>
