<template>
    <div :class="noPattern ? '' : 'bg-pokemon bg-repeat'">
        <!-- Flash Messages -->
        <flash-message />

        <nav v-if="!hideNav" class="fixed z-40 w-full bg-white shadow-md">
            <!-- Primary Navigation Menu -->
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center flex-shrink-0">
                            <inertia-link :href="route('home')">
                                <breeze-application-logo-avatar
                                    class="inline-block w-auto h-16"
                                />
                            </inertia-link>
                        </div>
                    </div>

                    <div class="hidden lg:flex lg:items-center lg:ml-6">
                        <!-- Navigation Links Desktop -->
                        <div
                            class="hidden space-x-6 lg:-my-px lg:ml-10 lg:flex"
                        >
                            <breeze-nav-link
                                :href="route('home')"
                                :active="route().current('home')"
                            >
                                Home
                            </breeze-nav-link>
                            <breeze-nav-link
                                :href="route('middleman/home')"
                                :active="route().current('middleman/*')"
                            >
                                Middleman
                            </breeze-nav-link>
                            <breeze-nav-link
                                :href="route('omaash/videos')"
                                :active="route().current('omaash/videos')"
                            >
                                Videos
                            </breeze-nav-link>
                            <breeze-nav-link
                                class="whitespace-nowrap"
                                :href="route('cards/sets')"
                                :active="route().current('cards/sets')"
                            >
                                Card List
                            </breeze-nav-link>
                            <breeze-nav-link
                                class="whitespace-nowrap"
                                :href="route('contact')"
                                :active="route().current('contact')"
                            >
                                Contact Me
                            </breeze-nav-link>
                            <breeze-nav-link
                                :href="route('faq')"
                                :active="route().current('faq')"
                            >
                                FAQ
                            </breeze-nav-link>
                            <!-- Login/Register Buttons -->
                            <breeze-nav-link
                                v-if="!$page.props.auth.user"
                                :href="route('login')"
                                :active="route().current('login')"
                            >
                                Login
                            </breeze-nav-link>
                            <inertia-link
                                v-if="!$page.props.auth.user"
                                :href="route('register')"
                                class="text-white font-bungee"
                            >
                                <breeze-button
                                    color="lightBlue"
                                    size="small"
                                    width="auto"
                                >
                                    Register
                                </breeze-button>
                            </inertia-link>
                        </div>

                        <!-- Settings Dropdown -->
                        <div v-if="$page.props.auth.user" class="relative">
                            <breeze-dropdown align="right" width="48">
                                <template #trigger>
                                    <div
                                        class="flex items-center justify-end pl-6 cursor-pointer"
                                    >
                                        <div
                                            v-if="$page.props.auth.user.avatar"
                                            class="object-cover w-16 h-16 p-0.5 overflow-hidden"
                                        >
                                            <img
                                                class="object-cover w-full h-full hover:bg-medGray border border-transparent hover:border-lightBlue p-0.5 transition-all ease-in-out duration-200"
                                                :src="
                                                    $page.props.auth.user.avatar
                                                "
                                                alt="user avatar"
                                            />
                                        </div>
                                        <user-circle-icon
                                            v-else
                                            class="w-12 h-12 border rounded-full text-medGray hover:text-lightBlue border-medGray"
                                        />
                                    </div>
                                </template>

                                <template #content>
                                    <breeze-dropdown-link
                                        v-if="
                                            $methods.isAdminRole(
                                                $page.props.auth.roles
                                            )
                                        "
                                        :href="route('admin/middleman/submissions')"
                                        as="button"
                                    >
                                        Admin
                                    </breeze-dropdown-link>
                                    <breeze-dropdown-link
                                        href="/user/profile"
                                        as="button"
                                    >
                                        Profile
                                    </breeze-dropdown-link>
                                    <breeze-dropdown-link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </breeze-dropdown-link>
                                </template>
                            </breeze-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center -mr-2 lg:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md text-lightBlue hover:text-lightBlue hover:bg-lightGray focus:outline-none focus:bg-lightGray focus:text-lightBlue"
                        >
                            <svg
                                class="w-6 h-6"
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

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="absolute left-0 right-0 bg-white shadow-md lg:hidden top-16"
            >
                <div class="p-4 space-y-1">
                    <breeze-responsive-nav-link
                        :href="route('home')"
                        :active="route().current('home')"
                    >
                        Home
                    </breeze-responsive-nav-link>
                    <breeze-responsive-nav-link
                        :href="route('middleman/home')"
                        :active="route().current('middleman/*')"
                    >
                        Middleman
                    </breeze-responsive-nav-link>
                    <breeze-responsive-nav-link
                        :href="route('omaash/videos')"
                        :active="route().current('omaash/videos')"
                    >
                        Videos
                    </breeze-responsive-nav-link>
                    <breeze-responsive-nav-link
                        :href="route('cards/sets')"
                        :active="route().current('cards/sets')"
                    >
                        Card List
                    </breeze-responsive-nav-link>
                    <breeze-responsive-nav-link
                        :href="route('contact')"
                        :active="route().current('contact')"
                    >
                        Contact Me
                    </breeze-responsive-nav-link>
                    <breeze-responsive-nav-link
                        :href="route('faq')"
                        :active="route().current('faq')"
                    >
                        FAQ
                    </breeze-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="p-4 border-t border-darkGray">
                    <breeze-responsive-nav-link
                        v-if="!$page.props.auth.user"
                        :href="route('login')"
                        :active="route().current('login')"
                    >
                        Login
                    </breeze-responsive-nav-link>

                    <inertia-link
                        v-if="!$page.props.auth.user"
                        :href="route('register')"
                        class="text-white font-bungee"
                    >
                        <breeze-button
                            color="lightBlue"
                            size="small"
                            class="w-full mt-4"
                        >
                            Register
                        </breeze-button>
                    </inertia-link>

                    <div v-if="$page.props.auth.user" class="space-y-1">
                        <breeze-responsive-nav-link
                            v-if="$methods.isAdminRole($page.props.auth.roles)"
                            :href="route('admin/middleman/submissions')"
                            :active="route().current('admin')"
                        >
                            Admin
                        </breeze-responsive-nav-link>
                        <breeze-responsive-nav-link
                            :href="route('profile')"
                            :active="route().current('profile')"
                        >
                            Profile
                        </breeze-responsive-nav-link>
                        <breeze-responsive-nav-link
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </breeze-responsive-nav-link>
                    </div>

                    <div
                        v-if="$page.props.auth.user"
                        class="flex items-center mt-3"
                    >
                        <div
                            v-if="$page.props.auth.user.avatar"
                            class="object-cover w-16 h-16 mr-4 p-0.5 overflow-hidden rounded-full"
                        >
                            <img
                                class="object-cover w-full h-full"
                                :src="$page.props.auth.user.avatar"
                                alt="user avatar"
                            />
                        </div>
                        <user-circle-icon
                            v-else
                            class="w-12 h-12 mr-4 border rounded-full text-lightBlue border-medGray"
                        />
                        <div>
                            <div class="text-sm font-bungee text-darkBlue">
                                {{ $page.props.auth.user.first_name }}
                                {{ $page.props.auth.user.last_name }}
                            </div>
                            <div class="text-xs font-medium text-darkGray">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="shadow no-print"
            :class="hideNav ? 'pt-0' : 'pt-16'"
        >
            <div class="object-cover bg-center bg-cover" :class="[bgClass]">
                <div
                    class="flex items-center justify-center h-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"
                    :class="[headerSizeClass]"
                >
                    <slot name="header" />
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main :class="hideNav && hideFooter ? 'min-h-screen' : 'min-h-96'">
            <slot />
        </main>

        <!-- Footer -->
        <footer
            v-if="!hideFooter"
            class="grid grid-cols-1 px-4 py-8 space-y-12 lg:grid-cols-2 bg-darkBlue min-h-32 sm:px-6 lg:px-8 lg:space-y-0"
        >
            <div class="flex items-center justify-center lg:justify-start">
                <breeze-application-logo />
            </div>
            <div>
                <div
                    class="flex flex-col items-center justify-end space-y-6 text-center lg:space-y-0 lg:space-x-6 lg:flex-row"
                >
                    <inertia-link
                        :href="route('home')"
                        class="text-white font-bungee"
                        >Home</inertia-link
                    >
                    <inertia-link
                        :href="route('middleman/home')"
                        class="text-white font-bungee"
                        >Middleman</inertia-link
                    >
                    <inertia-link
                        :href="route('omaash/videos')"
                        class="text-white font-bungee"
                        >Videos</inertia-link
                    >
                    <inertia-link
                        :href="route('cards/sets')"
                        class="text-white font-bungee whitespace-nowrap"
                        >Card List</inertia-link
                    >
                    <inertia-link
                        :href="route('contact')"
                        class="text-white font-bungee whitespace-nowrap"
                        >Contact Me</inertia-link
                    >
                    <inertia-link
                        :href="route('faq')"
                        class="text-white font-bungee whitespace-nowrap"
                        >FAQ</inertia-link
                    >
                </div>
                <div
                    class="grid items-center justify-center max-w-xs grid-cols-3 gap-6 mx-auto mt-12 text-center sm:max-w-full sm:gap-0 sm:space-x-6 sm:flex sm:items-center sm:justify-center lg:mt-6 lg:justify-end"
                >
                    <a href="https://youtube.com/omaash" target="_blank">
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><youtube-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a href="https://www.patreon.com/omaash" target="_blank">
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><patreon-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a href="https://instagram.com/omaash" target="_blank">
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><instagram-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a
                        href="https://facebook.com/omaashopenings"
                        target="_blank"
                    >
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><facebook-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a href="https://tiktok.com/@omaash" target="_blank">
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><tiktok-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a href="https://twitter.com/omaashnation" target="_blank">
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><twitter-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                    <a
                        href="https://shirts.org/collections/omaash"
                        target="_blank"
                    >
                        <breeze-button class="w-auto" width="auto" size="auto"
                            ><t-shirt-icon class="w-6 h-6"
                        /></breeze-button>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import BreezeApplicationLogo from "@/Components/ApplicationLogo";
    import BreezeApplicationLogoAvatar from "@/Components/ApplicationLogoAvatar";
    import BreezeDropdown from "@/Components/Dropdown";
    import BreezeDropdownLink from "@/Components/DropdownLink";
    import BreezeNavLink from "@/Components/NavLink";
    import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink";
    import BreezeButton from "@/Components/Button";
    import FlashMessage from "@/Components/FlashMessage";

    // Icons
    import TShirtIcon from "@/Components/Icons/TShirtIcon";
    import YoutubeIcon from "@/Components/Icons/YoutubeIcon";
    import InstagramIcon from "@/Components/Icons/InstagramIcon";
    import FacebookIcon from "@/Components/Icons/FacebookIcon";
    import TiktokIcon from "@/Components/Icons/TiktokIcon";
    import TwitterIcon from "@/Components/Icons/TwitterIcon";
    import PatreonIcon from "@/Components/Icons/PatreonIcon";
    import UserCircleIcon from "@/Components/Icons/UserCircleIcon";

    export default {
        props: {
            bgClass: {
                type: String,
                required: false,
                default: () => "bg-home",
            },
            noPattern: {
                type: Boolean,
                required: false,
                default: () => false,
            },
            headerSize: {
                type: String,
                default: "regular",
                required: false,
                validator(value) {
                    return ["small", "regular"].includes(value);
                },
            },
            hideNav: {
                type: Boolean,
                default: false,
                required: false,
            },
            hideFooter: {
                type: Boolean,
                default: false,
                required: false,
            },
        },
        components: {
            BreezeApplicationLogo,
            BreezeApplicationLogoAvatar,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
            BreezeButton,
            FlashMessage,
            // Icons
            TShirtIcon,
            YoutubeIcon,
            InstagramIcon,
            FacebookIcon,
            TiktokIcon,
            TwitterIcon,
            UserCircleIcon,
            PatreonIcon,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                headerSizeClass: {
                    "py-6 sm:py-12 min-h-48 sm:min-h-64":
                        this.headerSize === "regular",
                    "py-4 sm:py-8 min-h-24 sm:min-h-40":
                        this.headerSize === "small",
                },
            };
        },
    };
</script>
