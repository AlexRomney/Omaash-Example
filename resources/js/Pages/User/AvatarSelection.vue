<template>
    <breeze-layout
        bg-class="bg-avatar-selection"
        header-size="small"
        no-pattern
        id="top"
    >
        <template #header>
            <h2 class="text-4xl text-center text-white">Choose your Pokemon</h2>
        </template>

        <div class="px-4 py-6 mx-auto lg:max-w-5xl sm:px-6 lg:px-8">
            <div class="sticky grid grid-cols-1 gap-6 py-6 bg-white top-16">
                <div class="flex items-center w-full">
                    <!-- Search Bar -->
                    <form
                        @submit.prevent="getPokemonAvatars"
                        class="w-full h-full"
                    >
                        <div class="flex items-center h-full">
                            <breeze-input
                                ref="searchQuery"
                                id="searchQuery"
                                type="text"
                                placeholder="Search by pokemon name or type"
                                class="self-stretch block w-full h-full -mr-2"
                                v-model="searchQuery"
                                required
                            />

                            <breeze-button
                                width="auto"
                                size="small"
                                class="flex items-center"
                            >
                                <search-icon class="w-4 h-4" />
                                <span class="hidden ml-2 md:inline-block"
                                    >Search</span
                                >
                            </breeze-button>
                        </div>
                    </form>
                    <breeze-dropdown align="right" width="48">
                        <template #trigger>
                            <breeze-button
                                :no-click="true"
                                width="auto"
                                size="small"
                                class="flex items-center ml-2 cursor-pointer sm:ml-4"
                            >
                                <filter-icon class="w-4 h-4" />
                                <span class="hidden ml-2 md:inline-block"
                                    >Filter By</span
                                >
                            </breeze-button></template
                        >

                        <template #content>
                            <div
                                @click.prevent="handleFilterPokemon('sprite')"
                                class="p-2 cursor-pointer font-bungee"
                                :class="
                                    filteredBy === 'sprite'
                                        ? 'text-white bg-lightBlue hover:bg-opacity-75'
                                        : 'hover:bg-lightGray'
                                "
                            >
                                Sprite
                            </div>
                            <div
                                @click.prevent="handleFilterPokemon('original')"
                                class="p-2 cursor-pointer font-bungee"
                                :class="
                                    filteredBy === 'original'
                                        ? 'text-white bg-lightBlue hover:bg-opacity-75'
                                        : 'hover:bg-lightGray'
                                "
                            >
                                Original
                            </div>
                            <div
                                @click.prevent="handleFilterPokemon('shiny')"
                                class="p-2 cursor-pointer font-bungee"
                                :class="
                                    filteredBy === 'shiny'
                                        ? 'text-white bg-lightBlue hover:bg-opacity-75'
                                        : 'hover:bg-lightGray'
                                "
                            >
                                Shiny
                            </div>
                        </template>
                    </breeze-dropdown>
                    <breeze-button
                        @click.prevent="resetSearch"
                        width="auto"
                        class="flex items-center ml-2 sm:ml-4"
                        size="small"
                        color="darkGray"
                    >
                        <reset-icon class="w-4 h-4" />
                        <span class="hidden ml-2 md:inline-block"
                            >Reset</span
                        ></breeze-button
                    >
                </div>
            </div>

            <transition
                mode="out-in"
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="loading"
                    key="loading"
                    class="py-12 mx-auto text-center sm:py-24"
                >
                    <pokeball-loader :loading="loading" />
                </div>
                <ul
                    v-else-if="pokemon.length > 0"
                    role="list"
                    key="list"
                    class="grid grid-cols-3 py-6 mx-auto sm:py-12 gap-x-4 gap-y-8 sm:grid-cols-4 md:gap-x-6 md:grid-cols-5 lg:max-w-5xl lg:gap-x-8 lg:gap-y-12 xl:grid-cols-6"
                >
                    <li
                        v-for="poke in pokemonWithImages"
                        class="items-center justify-center w-24 h-24 p-0.5 mx-auto transition-all ease-in-out border-4 cursor-pointer sm:h-28 sm:w-28 lg:w-36 lg:h-36"
                        :class="[
                            selectedPokemon &&
                            poke.name === selectedPokemon.name
                                ? 'border-lightBlue bg-lightBlue bg-opacity-20'
                                : 'border-transparent',
                            poke[filterBy] ? 'flex' : 'hidden',
                        ]"
                        :key="poke.id"
                        @click.prevent="handlePokemonSelection(poke)"
                    >
                        <img
                            class="object-contain w-24 h-24 mx-auto bg-center lg:w-32 lg:h-32"
                            loading="lazy"
                            :src="poke[filterBy]"
                        />
                    </li>
                </ul>

                <div
                    v-else-if="searchQuery"
                    key="empty"
                    class="flex flex-col items-center justify-center max-w-xl py-12 mx-auto text-center sm:py-24"
                >
                    <div>
                        <img
                            class="object-contain w-16 h-auto"
                            src="/images/pokeball-empty.png"
                            alt=""
                        />
                    </div>
                    <h4 class="mt-6 text-2xl">Looks like you came up empty</h4>
                    <p class="mt-2">
                        Could not find any pokemon with your search. Please make
                        sure you spelled the pokemon you are looking for
                        correctly and try again.
                    </p>
                </div>
            </transition>

            <div
                class="fixed bottom-0 left-0 right-0 px-4 py-2 text-white border-t-4 shadow-2xl bg-lightGray border-lightBlue"
            >
                <div class="grid w-full max-w-5xl grid-cols-2 mx-auto">
                    <div class="flex items-center">
                        <transition
                            mode="out-in"
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0"
                            enter-to-class="opacity-100"
                            leave-active-class="transition duration-200 ease-in"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="selectedPokemon"
                                class="flex items-center"
                            >
                                <div
                                    class="flex flex-col items-center justify-center flex-shrink-0 mr-2 md:mr-4"
                                >
                                    <img
                                        class="object-contain mx-auto bg-center w-14 h-14 lg:w-16 lg:h-16"
                                        loading="lazy"
                                        :src="selectedPokemon[filterBy]"
                                    />
                                </div>
                                <breeze-button
                                    @click.prevent="updateAvatar"
                                    width="auto"
                                    size="small"
                                >
                                    <span class="hidden md:inline-block">
                                        I Choose
                                        {{
                                            $filters.uppercase(
                                                selectedPokemon.name
                                            )
                                        }}
                                    </span>
                                    <span class="w-full md:hidden md:w-auto"
                                        >Update</span
                                    >
                                </breeze-button>
                            </div>
                            <div v-else class="font-bungee text-lightBlue">
                                No Pokemon Selected
                            </div>
                        </transition>
                    </div>
                    <div class="flex items-center ml-auto">
                        <a href="#top" class="text-white font-bungee">
                            <breeze-button
                                :no-click="true"
                                width="auto"
                                class="flex items-center ml-4 cursor-pointer"
                                size="small"
                                color="darkGray"
                            >
                                <up-arrow-icon class="w-4 h-4" />
                                <span class="ml-2 md:hidden">Top</span>
                                <span class="hidden ml-2 md:inline-block"
                                    >Back to Top</span
                                >
                            </breeze-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import FilterIcon from "@/Components/Icons/FilterIcon";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import ResetIcon from "@/Components/Icons/ResetIcon";
    import UpArrowIcon from "@/Components/Icons/UpArrowIcon";
    import BreezeDropdown from "@/Components/Dropdown";
    import PokeballLoader from "@/Components/PokeballLoader";

    import axios from "axios";

    export default {
        components: {
            BreezeLayout,
            BreezeButton,
            BreezeInput,
            FilterIcon,
            SearchIcon,
            ResetIcon,
            UpArrowIcon,
            BreezeDropdown,
            PokeballLoader,
        },
        props: {
            auth: Object,
        },
        data() {
            return {
                loading: false,
                pokemon: [],
                selectedPokemon: null,
                searchQuery: "",
                filteredBy: "sprite",
            };
        },
        computed: {
            pokemonWithImages() {
                const pokemon = this.pokemon.filter((poke) => {
                    return poke.sprite_url || poke.shiny_sprite_url;
                });

                return pokemon;
            },
            filterBy() {
                if (this.filteredBy === "sprite") {
                    return "sprite_url";
                } else if (this.filteredBy === "original") {
                    return "official_artwork_url";
                } else {
                    return "shiny_sprite_url";
                }
            },
        },
        mounted() {
            this.$refs.searchQuery.focus();
            this.getPokemonAvatars();
        },
        methods: {
            handlePokemonSelection(pokemon) {
                this.selectedPokemon = pokemon;
            },
            getPokemonAvatars() {
                this.loading = true;
                setTimeout(() => {
                    axios
                        .get("/user/search-pokemon-avatars", {
                            params: { query: this.searchQuery },
                        })
                        .then((response) => {
                            this.pokemon = response.data.pokemon;
                            this.handleSetUserSelectedPokemon();
                        });
                }, 1000);
            },
            updateAvatar() {
                axios
                    .post("/user/avatar-selection", {
                        avatar: this.selectedPokemon[this.filterBy],
                    })
                    .then((response) => {
                        if (response.data.success) {
                            this.$inertia.visit("/user/profile", {
                                data: {
                                    updated: true,
                                },
                            });
                        }
                    });
            },
            resetSearch() {
                this.searchQuery = "";
                this.filterBy = "sprite";
                this.$refs.searchQuery.focus();
                this.getPokemonAvatars();
            },
            handleFilterPokemon(filter) {
                this.filteredBy = filter;
            },
            handleSetUserSelectedPokemon() {
                if (this.pokemon.length > 0) {
                    this.selectedPokemon = this.pokemon.find((pokemon) => {
                        let avatarUrl = this.auth.user.avatar;
                        if (avatarUrl === pokemon.sprite_url) {
                            this.filteredBy = "sprite";
                            return true;
                        } else if (avatarUrl === pokemon.official_artwork_url) {
                            this.filteredBy = "original";
                            return true;
                        } else if (avatarUrl === pokemon.shiny_sprite_url) {
                            this.filteredBy = "shiny";
                            return true;
                        } else {
                            return false;
                        }
                    });
                } else {
                    this.selectedPokemon = null;
                }
                this.loading = false;
            },
        },
    };
</script>
