import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

export const useMenuStore = defineStore("menu", () => {
    const menuItems = ref([
        // Các mục menu khác
    ]);
    const rooms = ref([]); // State để lưu danh sách phòng máy

    // Hành động để fetch phòng máy từ API
    const fetchRooms = async () => {
        try {
            const response = await axios.get("/api/rooms"); // Đảm bảo rằng bạn có endpoint này trong Laravel
            rooms.value = response.data; // Lưu danh sách phòng máy vào state
        } catch (error) {
            console.error("Error fetching rooms:", error);
        }
    };

    return {
        menuItems,
        rooms,
        fetchRooms,
    };
});
