<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ComputerLayout from "@/Components/ComputerLayout.vue";

defineProps({
    room: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="`Phòng máy ${room.id}`">
        <div
            class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg"
        >
            <ComputerLayout :room="room" />
        </div>
    </AppLayout>
</template>

<style scoped></style>
