<script setup>
defineProps({
    number: {
        type: Number,
        required: true,
    },
    network_status: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div
        :class="[
            'flex h-4 w-4 items-center justify-center rounded bg-gray-200 p-5 text-center font-semibold',
            network_status === 'Connected' ? 'border-4 border-green-500' : '',
        ]"
    >
        {{ number }}
    </div>
</template>

<style scoped></style>
