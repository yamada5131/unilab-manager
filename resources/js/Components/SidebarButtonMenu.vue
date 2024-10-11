<script setup>
import { computed } from "vue";
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    isRootLevel: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["toggle"]);

const classes = computed(() => {
    return {
        "pl-8": !props.isRootLevel,
    };
});
</script>
<template>
    <button
        @click="emit('toggle', item)"
        class="group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
        :class="classes"
    >
        <font-awesome-icon
            v-if="item.icon"
            :icon="item.icon"
            class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
        />

        <span
            class="ml-3 flex-1 whitespace-nowrap text-left"
            sidebar-toggle-item=""
            >{{ item.name }}</span
        >
        <svg
            sidebar-toggle-item=""
            class="h-6 w-6"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"
            ></path>
        </svg>
    </button>
</template>

<style scoped></style>
