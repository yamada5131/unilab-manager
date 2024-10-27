<script setup>
import { computed } from "vue";
import Computer from "@/Components/Computer.vue";

const props = defineProps({
    room: {
        type: Object,
        required: true,
    },
});

// define seat arrays using refs
const leftseats = computed(() => props.room.computers.slice(0, 24));
const rightseats = computed(() => props.room.computers.slice(24, 48));
</script>

<template>
    <div class="flex">
        <div class="grid basis-3/4 grid-cols-2 place-items-center p-10">
            <!-- row 1 -->
            <div class="grid grid-cols-4 grid-rows-6 place-items-center gap-4">
                <Computer
                    v-for="computer in leftseats"
                    :key="computer.id"
                    :network_status="computer.network_status"
                    :number="computer.id"
                />
            </div>

            <!-- row 2 -->
            <div class="grid grid-cols-4 grid-rows-6 place-items-center gap-4">
                <Computer
                    v-for="computer in rightseats"
                    :key="computer.id"
                    :network_status="computer.network_status"
                    :number="computer.id"
                />
            </div>
        </div>
        <div class="basis-1/4 bg-gray-200">
            <h1 class="p-10 text-center text-2xl font-semibold">
                Phòng máy {{ room.id }}
            </h1>
        </div>
    </div>
</template>

<style scoped></style>
