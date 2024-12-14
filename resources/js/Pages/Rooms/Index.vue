<template>
    <AppLayout>
        <div
            class="block items-center justify-between border-b border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800 sm:flex lg:mt-1.5"
        >
            <div class="mb-1">
                <fwb-breadcrumb class="mb-5">
                    <fwb-breadcrumb-item home href="#">
                        Home
                    </fwb-breadcrumb-item>
                    <fwb-breadcrumb-item href="#">
                        Quản lý phòng máy
                    </fwb-breadcrumb-item>
                    <fwb-breadcrumb-item>List</fwb-breadcrumb-item>
                </fwb-breadcrumb>
                <h1
                    class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl"
                >
                    All rooms
                </h1>

                <div class="block">
                    <fwb-button color="default" class="mt-4">
                        Thêm phòng mới
                    </fwb-button>
                </div>
            </div>
        </div>
        <fwb-table hoverable>
            <fwb-table-head>
                <fwb-table-head-cell>
                    <fwb-checkbox v-model="check" label="" />
                </fwb-table-head-cell>
                <fwb-table-head-cell>Tên phòng</fwb-table-head-cell>
                <fwb-table-head-cell>Sức chứa</fwb-table-head-cell>
                <fwb-table-head-cell>Mô tả</fwb-table-head-cell>
                <fwb-table-head-cell>Trạng thái</fwb-table-head-cell>
                <fwb-table-head-cell>Hành động</fwb-table-head-cell>
                <fwb-table-head-cell>
                    <span class="sr-only" @click="showModal">Edit</span>
                </fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <fwb-table-row v-for="room in rooms" :key="room.id">
                    <fwb-table-cell class="w-4 p-4">
                        <fwb-checkbox v-model="check" label="" />
                    </fwb-table-cell>
                    <fwb-table-cell
                        class="text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ room.name }}
                    </fwb-table-cell>
                    <fwb-table-cell
                        class="text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ room.capacity }}
                    </fwb-table-cell>
                    <fwb-table-cell
                        class="max-w-sm truncate text-base font-semibold text-gray-900 dark:text-white xl:max-w-xs"
                    >
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Minima, dolores nisi. Animi quasi cum, eius
                        blanditiis reprehenderit voluptas. Perferendis totam
                        autem tempore error mollitia velit assumenda ea natus
                        quam! Voluptatem.
                    </fwb-table-cell>
                    <fwb-table-cell
                        class="text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ room.is_available ? "Available" : "not ok" }}
                    </fwb-table-cell>
                    <fwb-table-cell class="flex justify-start space-x-2">
                        <fwb-button @click="showModal">Edit</fwb-button>
                        <fwb-button color="red">Delete</fwb-button>
                        <Link :href="route('rooms.show', { id: room.id })">
                            <fwb-button color="green">View</fwb-button>
                        </Link>
                    </fwb-table-cell>
                </fwb-table-row>
            </fwb-table-body>
        </fwb-table>
    </AppLayout>

    <fwb-modal v-if="isShowModal" @close="closeModal">
        <template #header>
            <div class="flex items-center text-lg">Edit room</div>
        </template>
        <template #body>
            <form action="#">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="first-name"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            First Name
                        </label>
                        <input
                            id="first-name"
                            type="text"
                            name="first-name"
                            value="Bonnie"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="Bonnie"
                            required=""
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="last-name"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Last Name
                        </label>
                        <input
                            id="last-name"
                            type="text"
                            name="last-name"
                            value="Green"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="Green"
                            required=""
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="bonnie@flowbite.com"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="example@company.com"
                            required=""
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="position"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Position
                        </label>
                        <input
                            id="position"
                            type="text"
                            name="position"
                            value="React Developer"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="e.g. React developer"
                            required=""
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="current-password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Current Password
                        </label>
                        <input
                            id="current-password"
                            type="password"
                            name="current-password"
                            value="••••••••"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="••••••••"
                            required=""
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label
                            for="new-password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            New Password
                        </label>
                        <input
                            id="new-password"
                            type="password"
                            name="new-password"
                            value="••••••••"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm"
                            placeholder="••••••••"
                            required=""
                        />
                    </div>
                    <div class="col-span-6">
                        <label
                            for="biography"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Biography
                        </label>
                        <textarea
                            id="biography"
                            rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="👨‍💻Full-stack web developer. Open-source contributor."
                        >
👨‍💻Full-stack web developer. Open-source contributor.</textarea
                        >
                    </div>
                </div>
            </form>
        </template>
        <template #footer>
            <div class="flex justify-between">
                <fwb-button color="alternative" @click="closeModal">
                    Decline
                </fwb-button>
                <fwb-button color="green" @click="closeModal">
                    Save all
                </fwb-button>
            </div>
        </template>
    </fwb-modal>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {
    FwbBreadcrumb,
    FwbBreadcrumbItem,
    FwbButton,
    FwbModal,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
} from "flowbite-vue";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    rooms: {
        type: Array,
        required: true,
    },
});

const isShowModal = ref(false);

function closeModal() {
    isShowModal.value = false;
}
function showModal() {
    isShowModal.value = true;
}
import { FwbCheckbox } from "flowbite-vue";

const check = ref(false);
</script>
