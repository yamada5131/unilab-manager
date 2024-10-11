<script setup>
import NavLink from "@/Components/NavLink.vue";
import SidebarButtonMenu from "@/Components/SidebarButtonMenu.vue";
defineProps({
    isRootLevel: {
        type: Boolean,
        default: true,
    },
    menuItems: {
        type: Array,
        required: true,
    },
});
const toggle = (item) => {
    item.isOpen = !item.isOpen;
};
</script>

<template>
    <ul class="space-y-2 py-2">
        <li v-if="isRootLevel">
            <form action="#" method="GET" class="lg:hidden">
                <label for="mobile-search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                    >
                        <svg
                            class="h-5 w-5 text-gray-500"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="email"
                        id="mobile-search"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400"
                        placeholder="Search"
                    />
                </div>
            </form>
        </li>
        <li v-for="item in menuItems" :key="item.name">
            <!-- Hiển thị <NavLink> hoặc <ButtonMenu> tùy thuộc vào item có children hay không -->
            <NavLink
                v-if="!item.children.length"
                :href="route(item.route)"
                :active="route().current(item.route)"
                :icon="item.icon"
                :isRootLevel="isRootLevel"
            >
                {{ item.name }}
            </NavLink>

            <SidebarButtonMenu
                v-else
                :item="item"
                @toggle="toggle"
                :isRootLevel="isRootLevel"
            />
            <ul v-if="item.isOpen && item.children.length > 0">
                <SidebarMenu :menuItems="item.children" :isRootLevel="false" />
            </ul>
        </li>
    </ul>
</template>

<style scoped></style>
