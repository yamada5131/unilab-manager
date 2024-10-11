<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    icon: [String, Array], // Thêm prop cho icon
    active: Boolean,
    isRootLevel: {
        type: Boolean,
        default: true,
    },
});

const classes = computed(() => {
    return props.active
        ? "group flex items-center rounded-lg p-2 text-base text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 !text-blue-700 hover:!text-blue-700 dark:!text-blue-500 dark:hover:!text-blue-500 font-bold"
        : "group flex items-center rounded-lg p-2 text-base text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700";
});

// Thêm padding-left cho các mục con nếu không phải root
const dynamicPadding = computed(() => {
    return props.isRootLevel ? "" : "pl-8";
});
</script>

<template>
    <Link :href="href" :class="[classes, dynamicPadding]">
        <font-awesome-icon
            v-if="icon"
            :icon="icon"
            class="h-5 w-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
        />
        <span class="ml-3"><slot /></span>
    </Link>
</template>
