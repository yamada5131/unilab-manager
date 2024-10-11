<script setup>
import { ref, onMounted } from "vue";
import { Head, router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Sidebar from "@/Components/Sidebar.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
defineProps({
    title: String,
});
// Biến trạng thái dark mode
const isDarkMode = ref(false);
const sidebarOpen = ref(false);
const submenuOpen = ref(false);
const showingNavigationDropdown = ref(false);

const toggleSideBar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const toggleSubmenuOpen = () => {
    submenuOpen.value = !submenuOpen.value;
};

const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        },
    );
};

const logout = () => {
    router.post(route("logout"));
};

// Hàm để kiểm tra và cập nhật trạng thái dark mode khi tải trang
const checkTheme = () => {
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        isDarkMode.value = true;
    } else {
        isDarkMode.value = false;
    }
};

// Hàm để bật/tắt dark mode
const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;

    if (isDarkMode.value) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
    }
};

// Chạy hàm kiểm tra theme khi component được mount
onMounted(() => {
    checkTheme();
});
</script>

<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <Head :title="title" />

        <Banner />

        <nav
            class="fixed z-30 w-full border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800"
        >
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button
                            @click="toggleSideBar"
                            id="toggleSidebarMobile"
                            aria-expanded="true"
                            aria-controls="sidebar"
                            class="cursor-pointer rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:bg-gray-700 dark:focus:ring-gray-700 lg:hidden"
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
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
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
                                    fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                        <a
                            href="https://flowbite-admin-dashboard.vercel.app/"
                            class="ml-2 flex md:mr-24"
                        >
                            <img
                                src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg"
                                class="mr-3 h-8"
                                alt="FlowBite Logo"
                            />
                            <span
                                class="self-center whitespace-nowrap text-xl font-semibold dark:text-white sm:text-2xl"
                                >Flowbite</span
                            >
                        </a>
                        <form
                            action="#"
                            method="GET"
                            class="hidden lg:block lg:pl-3.5"
                        >
                            <label for="topbar-search" class="sr-only"
                                >Search</label
                            >
                            <div class="relative mt-1 lg:w-96">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                >
                                    <svg
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400"
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
                                    id="topbar-search"
                                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                    placeholder="Search"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center">
                        <button
                            id="toggleSidebarMobileSearch"
                            type="button"
                            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:hidden"
                        >
                            <span class="sr-only">Search</span>

                            <svg
                                class="h-6 w-6"
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
                        </button>

                        <button
                            id="theme-toggle"
                            @click="toggleTheme"
                            data-tooltip-target="tooltip-toggle"
                            type="button"
                            class="rounded-lg p-2.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
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
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
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
                        <div
                            id="tooltip-toggle"
                            role="tooltip"
                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300"
                            style="
                                position: absolute;
                                inset: 0px auto auto 0px;
                                margin: 0px;
                                transform: translate3d(
                                    1219.67px,
                                    62.6667px,
                                    0px
                                );
                            "
                            data-popper-placement="bottom"
                        >
                            Toggle dark mode
                            <div
                                class="tooltip-arrow"
                                data-popper-arrow=""
                                style="
                                    position: absolute;
                                    left: 0px;
                                    transform: translate3d(68.6667px, 0px, 0px);
                                "
                            ></div>
                        </div>

                        <div class="ml-3 flex items-center">
                            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                                <div class="relative ms-3">
                                    <!-- Teams Dropdown -->
                                    <Dropdown
                                        v-if="
                                            $page.props.jetstream
                                                .hasTeamFeatures
                                        "
                                        align="right"
                                        width="60"
                                    >
                                        <template #trigger>
                                            <span
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700"
                                                >
                                                    {{
                                                        $page.props.auth.user
                                                            .current_team.name
                                                    }}

                                                    <svg
                                                        class="-me-0.5 ms-2 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <DropdownLink
                                                    :href="
                                                        route(
                                                            'teams.show',
                                                            $page.props.auth
                                                                .user
                                                                .current_team,
                                                        )
                                                    "
                                                >
                                                    Team Settings
                                                </DropdownLink>

                                                <DropdownLink
                                                    v-if="
                                                        $page.props.jetstream
                                                            .canCreateTeams
                                                    "
                                                    :href="
                                                        route('teams.create')
                                                    "
                                                >
                                                    Create New Team
                                                </DropdownLink>

                                                <!-- Team Switcher -->
                                                <template
                                                    v-if="
                                                        $page.props.auth.user
                                                            .all_teams.length >
                                                        1
                                                    "
                                                >
                                                    <div
                                                        class="border-t border-gray-200 dark:border-gray-600"
                                                    />

                                                    <div
                                                        class="block px-4 py-2 text-xs text-gray-400"
                                                    >
                                                        Switch Teams
                                                    </div>

                                                    <template
                                                        v-for="team in $page
                                                            .props.auth.user
                                                            .all_teams"
                                                        :key="team.id"
                                                    >
                                                        <form
                                                            @submit.prevent="
                                                                switchToTeam(
                                                                    team,
                                                                )
                                                            "
                                                        >
                                                            <DropdownLink
                                                                as="button"
                                                            >
                                                                <div
                                                                    class="flex items-center"
                                                                >
                                                                    <svg
                                                                        v-if="
                                                                            team.id ==
                                                                            $page
                                                                                .props
                                                                                .auth
                                                                                .user
                                                                                .current_team_id
                                                                        "
                                                                        class="me-2 h-5 w-5 text-green-400"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none"
                                                                        viewBox="0 0 24 24"
                                                                        stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                    >
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                        />
                                                                    </svg>

                                                                    <div>
                                                                        {{
                                                                            team.name
                                                                        }}
                                                                    </div>
                                                                </div>
                                                            </DropdownLink>
                                                        </form>
                                                    </template>
                                                </template>
                                            </div>
                                        </template>
                                    </Dropdown>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="relative ms-3">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button
                                                v-if="
                                                    $page.props.jetstream
                                                        .managesProfilePhotos
                                                "
                                                class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none"
                                            >
                                                <img
                                                    class="h-8 w-8 rounded-full object-cover"
                                                    :src="
                                                        $page.props.auth.user
                                                            .profile_photo_url
                                                    "
                                                    :alt="
                                                        $page.props.auth.user
                                                            .name
                                                    "
                                                />
                                            </button>

                                            <span
                                                v-else
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700"
                                                >
                                                    {{
                                                        $page.props.auth.user
                                                            .name
                                                    }}

                                                    <svg
                                                        class="-me-0.5 ms-2 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Manage Account
                                            </div>

                                            <DropdownLink
                                                :href="route('profile.show')"
                                            >
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasApiFeatures
                                                "
                                                :href="
                                                    route('api-tokens.index')
                                                "
                                            >
                                                API Tokens
                                            </DropdownLink>

                                            <div
                                                class="border-t border-gray-200 dark:border-gray-600"
                                            />

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button
                                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                                    @click="
                                        showingNavigationDropdown =
                                            !showingNavigationDropdown
                                    "
                                >
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex':
                                                    !showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex':
                                                    showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Dashboard
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div
                    class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                >
                    <div class="flex items-center px-4">
                        <div
                            v-if="$page.props.jetstream.managesProfilePhotos"
                            class="me-3 shrink-0"
                        >
                            <img
                                class="h-10 w-10 rounded-full object-cover"
                                :src="$page.props.auth.user.profile_photo_url"
                                :alt="$page.props.auth.user.name"
                            />
                        </div>

                        <div>
                            <div
                                class="text-base font-medium text-gray-800 dark:text-gray-200"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('profile.show')"
                            :active="route().current('profile.show')"
                        >
                            Profile
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            v-if="$page.props.jetstream.hasApiFeatures"
                            :href="route('api-tokens.index')"
                            :active="route().current('api-tokens.index')"
                        >
                            API Tokens
                        </ResponsiveNavLink>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <ResponsiveNavLink as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.props.jetstream.hasTeamFeatures">
                            <div
                                class="border-t border-gray-200 dark:border-gray-600"
                            />

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <ResponsiveNavLink
                                :href="
                                    route(
                                        'teams.show',
                                        $page.props.auth.user.current_team,
                                    )
                                "
                                :active="route().current('teams.show')"
                            >
                                Team Settings
                            </ResponsiveNavLink>

                            <ResponsiveNavLink
                                v-if="$page.props.jetstream.canCreateTeams"
                                :href="route('teams.create')"
                                :active="route().current('teams.create')"
                            >
                                Create New Team
                            </ResponsiveNavLink>

                            <!-- Team Switcher -->
                            <template
                                v-if="
                                    $page.props.auth.user.all_teams.length > 1
                                "
                            >
                                <div
                                    class="border-t border-gray-200 dark:border-gray-600"
                                />

                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Switch Teams
                                </div>

                                <template
                                    v-for="team in $page.props.auth.user
                                        .all_teams"
                                    :key="team.id"
                                >
                                    <form @submit.prevent="switchToTeam(team)">
                                        <ResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                    v-if="
                                                        team.id ==
                                                        $page.props.auth.user
                                                            .current_team_id
                                                    "
                                                    class="me-2 h-5 w-5 text-green-400"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </ResponsiveNavLink>
                                    </form>
                                </template>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">
            <Sidebar
                :sidebarOpen="sidebarOpen"
                @submenu-open="toggleSubmenuOpen"
                @toggleSideBar="toggleSideBar"
                :submenuOpen="submenuOpen"
            />
            <!-- Page Heading -->
            <div
                v-if="sidebarOpen"
                class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90"
                id="sidebarBackdrop"
                @click="sidebarOpen = false"
            ></div>
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
            </div>
        </div>
    </div>
</template>
