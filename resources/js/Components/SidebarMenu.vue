<script setup>
import SidebarMenuItem from "@/Components/SidebarMenuItem.vue";
import SearchBar from "@/Components/SearchBar.vue";
import { useMenuStore } from "@/useMenuStore.js";

defineProps({
    menuItems: {
        type: Array,
        required: true,
    },
    level: {
        type: Number,
        default: 1,
    },
});

const menuStore = useMenuStore();
const toggle = (itemName) => {
    menuStore.toggleMenuItem(itemName);
};
const isActive = (item) => {
    if (route().current(item.route, item.params || {})) {
        return true;
    }

    // Check recursively if any child is active
    return item.children.some((child) => isActive(child));
};
</script>

<template>
    <ul class="space-y-2 py-2">
        <li v-if="level === 1">
            <SearchBar :class="['lg:hidden']" />
        </li>
        <li v-for="item in menuItems" :key="item.name">
            <SidebarMenuItem
                :is-active="isActive(item)"
                :item="item"
                :level="level"
                @toggle="toggle"
            />
            <ul
                v-show="
                    item.isOpen && item.children && item.children.length > 0
                "
            >
                <SidebarMenu :level="level + 1" :menu-items="item.children" />
            </ul>
        </li>
    </ul>
</template>

<style scoped></style>
