<script setup lang="ts">
import { onMounted, ref } from "vue";
import { Head } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Footer from "@/Components/Footer.vue";
import NavBar from "@/Components/NavBar.vue";
import SearchBar from "@/Components/SearchBar.vue";
import Sidebar from "@/Components/Sidebar.vue";

defineProps({
    title: {
        type: String,
        required: true,
    },
});

const isDarkMode = ref(false);
const sidebarOpen = ref(false);

const checkTheme = () => {
    isDarkMode.value =
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches);
};

const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;
    document.documentElement.classList.toggle("dark", isDarkMode.value);
    localStorage.setItem("color-theme", isDarkMode.value ? "dark" : "light");
};

onMounted(() => {
    checkTheme();
});
</script>

<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <Head :title="title" />

        <Banner />

        <NavBar>
            <template #toggle-sidebar>
                <button
                    id="toggleSidebarMobile"
                    aria-controls="sidebar"
                    aria-expanded="true"
                    class="cursor-pointer rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:bg-gray-700 dark:focus:ring-gray-700 lg:hidden"
                    @click="toggleSideBar"
                >
                    <svg
                        v-if="sidebarOpen"
                        id="toggleSidebarMobileClose"
                        class="h-6 w-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                    <svg
                        v-else
                        id="toggleSidebarMobileHamburger"
                        class="h-6 w-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </template>
            <template #search-bar>
                <SearchBar :class="['hidden lg:block']" />
            </template>
            <template #theme-toggle>
                <button
                    id="theme-toggle"
                    class="rounded-lg p-2.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                    data-tooltip-target="tooltip-toggle"
                    type="button"
                    @click="toggleTheme"
                >
                    <svg
                        v-if="isDarkMode"
                        id="theme-toggle-light-icon"
                        class="h-5 w-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                    <svg
                        v-else
                        id="theme-toggle-dark-icon"
                        class="h-5 w-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                        ></path>
                    </svg>
                </button>
            </template>
        </NavBar>
        <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">
            <Sidebar :sidebar-open="sidebarOpen" />
            <header
                v-if="$slots.header"
                class="bg-white shadow dark:bg-gray-800"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <div
                class="relative h-full w-full overflow-y-auto bg-gray-50 dark:bg-gray-900 lg:ml-64"
            >
                <main>
                    <slot />
                </main>
                <Footer />
            </div>
        </div>
    </div>
</template>
