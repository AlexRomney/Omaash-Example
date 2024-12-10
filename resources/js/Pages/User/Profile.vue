<template>
    <breeze-layout bg-class="bg-profile">
        <template #header>
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-4xl text-center text-white">Profile</h2>
                <alert
                    class="mt-4"
                    :show="showUpdateAlert"
                    type="success"
                    title="Avatar Updated"
                    :description="
                        pokemon && pokemon.type
                            ? `${$filters.uppercase(
                                  pokemon.name
                              )}, I choose you!`
                            : 'You have no pokemon yet!'
                    "
                />
            </div>
        </template>

        <!-- Pokemon Card -->
        <div class="max-w-xl px-4 pb-16 mx-auto sm:px-6 lg:px-8">
            <div class="mt-4 sm:-mt-8">
                <div
                    :class="imageTextureBackground"
                    class="p-4 bg-no-repeat bg-cover border-8 rounded-lg shadow-2xl sm:p-8 sm:border-16 border-pokemon-yellow"
                >
                    <!-- Heading name and edit -->
                    <div class="flex items-center justify-between">
                        <h2 :class="typeColor" class="text-xl sm:text-2xl">
                            {{ auth.user.username }}
                        </h2>
                        <inertia-link
                            :href="this.route('user/show-profile')"
                            class="p-1 cursor-pointer sm:p-2"
                        >
                            <edit-icon
                                :class="typeColor"
                                class="w-4 h-4 sm:w-6 sm:h-6"
                            />
                        </inertia-link>
                    </div>
                    <!-- Avatar image -->
                    <inertia-link :href="route('avatar-selection')">
                        <div
                            :class="imageTypeBackground"
                            class="relative flex items-center justify-center h-40 mt-2 bg-no-repeat bg-cover border-4 border-opacity-75 rounded-lg cursor-pointer sm:border-8 sm:h-64 sm:mt-4 border-pokemon-yellow"
                        >
                            <div
                                class="absolute inset-0 z-10 bg-opacity-25 bg-medGray"
                            />
                            <img
                                v-if="auth.user.avatar"
                                class="z-20 object-contain w-full h-full max-h-32 sm:max-h-56"
                                :src="auth.user.avatar"
                                alt="Avatar"
                            />
                            <div
                                v-else
                                class="flex flex-col items-center justify-center"
                            >
                                <user-circle-icon
                                    :class="typeColor"
                                    class="w-16 h-16 rounded-full"
                                />
                                <p class="mt-2 font-bungee">
                                    Choose Your Pokemon!
                                </p>
                            </div>
                            <div
                                class="absolute font-bungee bottom-0 right-0 px-2 py-0.5 mb-1 mr-1 text-xs text-white rounded-tl-lg rounded-br-lg sm:hidden bg-lightBlue"
                            >
                                {{ pokemon ? "Update" : "Choose" }}
                            </div>
                            <div
                                class="absolute inset-0 z-20 items-center justify-center hidden text-white transition-all ease-in-out transform bg-opacity-75 opacity-0 sm:flex font-bungee hover:opacity-100 bg-lightBlue"
                            >
                                {{
                                    pokemon
                                        ? "Update Pokemon"
                                        : "Choose Pokemon"
                                }}
                            </div>
                        </div>
                    </inertia-link>
                    <!-- Shipping -->
                    <div
                        :class="typeBorder"
                        class="py-4 text-sm border-b-2 sm:py-8 sm:text-lg"
                    >
                        <p
                            :class="typeColor"
                            class="text-base sm:text-xl font-bungee"
                        >
                            Address
                        </p>
                        <p :class="typeColor">
                            {{ auth.user.first_name }}
                            {{ auth.user.last_name }}
                        </p>
                        <div v-if="auth.user.shipping_type === 'states'">
                            <p :class="typeColor">{{ auth.user.address }}</p>
                            <p :class="typeColor">
                                {{ auth.user.city }} {{ auth.user.state }},
                                {{ auth.user.zip }}
                            </p>
                        </div>
                        <div v-else>
                            <p :class="typeColor">
                                {{ auth.user.international_address }}
                            </p>
                        </div>
                    </div>
                    <!-- Payment info -->
                    <div class="pt-4 text-sm sm:pt-8 sm:text-xl">
                        <p
                            :class="typeColor"
                            class="text-base sm:text-xl font-bungee"
                        >
                            Personal Info
                        </p>
                        <p :class="typeColor">
                            Payment Type:
                            {{ $filters.uppercase(auth.user.payment_type) }}
                        </p>
                        <p :class="typeColor">
                            {{ $filters.uppercase(auth.user.contact_type) }}:
                            {{ auth.user.contact_handle }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Pokemon Card -->
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Alert from "@/Components/Alert";
    import BreezeButton from "@/Components/Button";
    import EditIcon from "@/Components/Icons/EditIcon";
    import UserCircleIcon from "@/Components/Icons/UserCircleIcon";

    export default {
        components: {
            BreezeLayout,
            Alert,
            BreezeButton,
            EditIcon,
            UserCircleIcon,
        },
        props: {
            auth: Object,
            pokemon: Object,
        },
        data() {
            return {
                showUpdateAlert: false,
            };
        },
        mounted() {
            this.handleQueryCheck();
        },
        methods: {
            handleQueryCheck() {
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const updated = urlParams.get("updated");
                if (updated) {
                    this.showUpdateAlert = true;
                    setTimeout(() => {
                        this.showUpdateAlert = false;
                        window.history.pushState(
                            {},
                            document.title,
                            window.location.pathname
                        );
                    }, 3000);
                }
            },
            handleEditProfile() {
                this.form = this.auth.user;
                this.showEditProfile = !this.showEditProfile;
            },
        },
        computed: {
            imageTypeBackground() {
                if (this.pokemon) {
                    switch (this.pokemon.type) {
                        case "fire":
                            return "bg-type-fire";
                        case "bug":
                            return "bg-type-bug";
                        case "dark":
                            return "bg-type-dark";
                        case "dragon":
                            return "bg-type-dragon";
                        case "electric":
                            return "bg-type-electric";
                        case "fairy":
                            return "bg-type-fairy";
                        case "fighting":
                            return "bg-type-fighting";
                        case "flying":
                            return "bg-type-flying";
                        case "ghost":
                            return "bg-type-ghost";
                        case "grass":
                            return "bg-type-grass";
                        case "ground":
                            return "bg-type-ground";
                        case "ice":
                            return "bg-type-ice";
                        case "poison":
                            return "bg-type-poison";
                        case "psychic":
                            return "bg-type-psychic";
                        case "rock":
                            return "bg-type-rock";
                        case "steel":
                            return "bg-type-steel";
                        case "water":
                            return "bg-type-water";
                        default:
                            return "bg-type-normal";
                    }
                } else {
                    return "bg-type-normal";
                }
            },
            imageTextureBackground() {
                if (this.pokemon) {
                    switch (this.pokemon.type) {
                        case "fire":
                            return "bg-texture-fire";
                        case "bug":
                            return "bg-texture-bug";
                        case "dark":
                            return "bg-texture-dark";
                        case "dragon":
                            return "bg-texture-dragon";
                        case "electric":
                            return "bg-texture-electric";
                        case "fairy":
                            return "bg-texture-fairy";
                        case "fighting":
                            return "bg-texture-fighting";
                        case "flying":
                            return "bg-texture-flying";
                        case "ghost":
                            return "bg-texture-ghost";
                        case "grass":
                            return "bg-texture-grass";
                        case "ground":
                            return "bg-texture-ground";
                        case "ice":
                            return "bg-texture-ice";
                        case "poison":
                            return "bg-texture-poison";
                        case "psychic":
                            return "bg-texture-psychic";
                        case "rock":
                            return "bg-texture-rock";
                        case "steel":
                            return "bg-texture-steel";
                        case "water":
                            return "bg-texture-water";
                        default:
                            return "bg-texture-normal";
                    }
                } else {
                    return "bg-texture-normal";
                }
            },
            typeColor() {
                if (this.pokemon) {
                    switch (this.pokemon.type) {
                        case "dark":
                            return "text-white";
                        default:
                            return "text-black";
                    }
                } else {
                    return "text-darkBlue";
                }
            },
            typeBorder() {
                if (this.pokemon) {
                    switch (this.pokemon.type) {
                        case "dark":
                            return "border-white";
                        default:
                            return "border-black";
                    }
                } else {
                    return "border-black";
                }
            },
        },
    };
</script>
