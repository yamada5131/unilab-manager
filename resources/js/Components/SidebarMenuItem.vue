<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
import { computed } from "vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    level: {
        type: Number,
        default: 1,
    },
    isActive: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["toggle"]);

const paddingStyle = computed(() => {
    const level = props.level;
    return level > 1 ? { paddingLeft: `${level * 20}px` } : {};
});
</script>

<template>
    <div>
        <!-- Nếu không có children, dùng NavLink -->
        <NavLink
            v-if="!item.children || !item.children.length"
            :active="isActive"
            :href="route(item.route, item.params)"
            :icon="item.icon"
            :style="paddingStyle"
        >
            {{ item.name }}
        </NavLink>

        <!-- Nếu có children, dùng SidebarButtonMenu -->
        <button
            v-else
            :style="paddingStyle"
            class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            @click="emit('toggle', item.name)"
        >
            <font-awesome-icon
                v-if="item.icon"
                :icon="item.icon"
                class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            />

            <span
                class="ml-3 flex-1 overflow-hidden text-ellipsis whitespace-nowrap text-left"
            >
                {{ item.name }}
            </span>
            <svg
                class="h-6 w-6 flex-shrink-0"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    clip-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    fill-rule="evenodd"
                ></path>
            </svg>
        </button>
    </div>
</template>
