<script setup>
import { useMenuStore } from "@/useMenuStore";
import { Link } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { onMounted } from "vue";
import { FwbSidebar, FwbSidebarItem } from "flowbite-vue";

const menuStore = useMenuStore();
const { rooms } = storeToRefs(menuStore);

// Fetch các phòng máy khi component được mount
onMounted(async () => {
    await menuStore.fetchRooms();
});
</script>

<template>
    <fwb-sidebar
        class="fixed z-20 border-r border-gray-200 bg-white pt-16 dark:border-gray-700 dark:bg-gray-800"
    >
        <fwb-sidebar-item class="">
            <template #icon>
                <svg
                    class="h-5 w-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 22 21"
                >
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"
                    />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"
                    />
                </svg>
            </template>
            <template #default>Dashboard</template>
        </fwb-sidebar-item>
        <Link
            :href="route('rooms.index')"
            method="get"
            as="button"
            type="button"
        >
            <fwb-sidebar-item>
                <template #icon>
                    <font-awesome-icon
                        :icon="['fas', 'desktop']"
                        class="h-5 w-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    />
                </template>
                <template #default>
                    <span class="">Quản lý phòng máy</span>
                </template>
            </fwb-sidebar-item>
        </Link>
    </fwb-sidebar>
</template>
