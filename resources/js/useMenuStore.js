import { defineStore } from "pinia";
import { ref } from "vue";

export const useMenuStore = defineStore("menu", () => {
    const menuItems = ref([
        {
            name: "Dashboard",
            route: "dashboard",
            icon: "fa-solid fa-chart-line",
            isOpen: false,
            children: [],
        },
        {
            name: "Phòng máy",
            route: "rooms",
            icon: "fa-solid fa-computer",
            isOpen: false,
            children: [
                {
                    name: "Danh sách phòng máy",
                    route: "rooms.index",
                    isOpen: false,
                    children: [
                        {
                            name: "Phòng máy 1",
                            route: "rooms.show",
                            params: { room: 1 },
                            isOpen: false,
                            children: [],
                        },
                        {
                            name: "Phòng máy 2",
                            route: "rooms.show",
                            params: { room: 2 },
                            isOpen: false,
                            children: [],
                        },
                        {
                            name: "Phòng máy 3",
                            route: "rooms.show",
                            params: { room: 3 },
                            isOpen: false,
                            children: [],
                        },
                    ],
                },
                {
                    name: "Thêm phòng máy",
                    route: "rooms.create",
                    isOpen: false,
                    children: [],
                },
            ],
        },
        // ... other menu items
    ]);

    const toggleMenuItem = (itemName) => {
        const toggleItem = (items) => {
            for (const item of items) {
                if (item.name === itemName) {
                    item.isOpen = !item.isOpen;
                    break;
                }
                if (item.children && item.children.length) {
                    toggleItem(item.children);
                }
            }
        };
        toggleItem(menuItems.value);
    };

    return {
        menuItems,
        toggleMenuItem,
    };
});
