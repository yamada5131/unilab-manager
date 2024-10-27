<script setup>
import Welcome from "@/Components/Welcome.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- <template #header> -->
        <!--     <h2 -->
        <!--         class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200" -->
        <!--     > -->
        <!--         Dashboard -->
        <!--     </h2> -->
        <!-- </template> -->
        <div
            class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg"
        >
            <Welcome />
        </div>
    </AppLayout>
</template>
