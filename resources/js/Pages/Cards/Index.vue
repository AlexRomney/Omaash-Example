<template>
    <div>
        <breeze-layout bg-class="bg-pokemon-cards" header-size="small">
            <template #header>
                <h2 class="text-4xl text-center text-white">Pokemon TCG</h2>
            </template>

            <div class="relative lg:grid lg:grid-cols-5">
                <!-- Sidebar -->
                <div
                    class="sticky flex-col items-center hidden gap-2 p-4 overflow-y-scroll bg-lightGray top-16 lg:col-span-1 lg:flex sidebar"
                >
                    <div class="w-full p-3">
                        <h3 class="text-xl text-left">Popular Searches</h3>
                    </div>
                    <div
                        v-for="(card, index) in topPokemon"
                        :key="index"
                        class="w-full"
                        @click.prevent="handleSidebarSearch(card.name)"
                    >
                        <div
                            class="flex items-center p-3 rounded-sm cursor-pointer group hover:bg-lightBlue"
                        >
                            <div class="w-12 h-auto">
                                <img
                                    :src="card.sprite"
                                    alt=""
                                    class="object-contain w-12 h-auto"
                                />
                            </div>
                            <div
                                class="ml-4 text-base font-bold group-hover:text-white"
                            >
                                {{ card.name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:col-span-4">
                    <!-- Search Bar -->
                    <div
                        class="grid grid-cols-1 gap-4 px-4 pt-6 mx-auto max-w-7xl md:pt-12 md:gap-12 lg:px-8 sm:px-6 md:grid-cols-3"
                    >
                        <div
                            class="flex flex-col items-center w-full md:col-span-2"
                        >
                            <!-- Search Bar -->
                            <form
                                @submit.prevent="submitSearch"
                                class="w-full h-full"
                            >
                                <div class="flex items-center h-full">
                                    <breeze-input
                                        ref="query"
                                        id="query"
                                        type="text"
                                        placeholder="Search by card name or artist"
                                        class="z-10 self-stretch block w-full h-full"
                                        v-model="form.query"
                                        required
                                    />
                                    <breeze-button
                                        width="auto"
                                        size="small"
                                        class="z-20 flex items-center -ml-2"
                                    >
                                        <search-icon class="w-4 h-4" />
                                        <span class="hidden ml-2 sm:block"
                                            >Search Cards</span
                                        >
                                    </breeze-button>
                                </div>
                            </form>
                            <div
                                class="flex items-center w-full mt-2 text-sm sm:flex-row"
                            >
                                Want to search by set or series?
                                <inertia-link
                                    :href="route('cards/sets')"
                                    class="ml-1 underline text-lightBlue"
                                >
                                    Search by Set/Series
                                </inertia-link>
                            </div>
                        </div>
                        <breeze-button
                            @click.prevent="resetSearch"
                            class="w-auto mt-0 lg:hidden"
                            width="full"
                            size="small"
                            color="darkGray"
                            >Reset</breeze-button
                        >
                        <breeze-button
                            @click.prevent="resetSearch"
                            class="hidden w-auto mt-0 ml-auto lg:block"
                            width="full"
                            size="small"
                            color="darkGray"
                            >Reset</breeze-button
                        >
                    </div>

                    <!-- Series and Sets -->
                    <div
                        v-if="cards.length === 0 || cards.data.length === 0"
                        class="max-w-xl px-4 py-12 mx-auto text-center sm:px-6 lg:px-8 md:py-24"
                    >
                        <div class="w-56 h-auto mx-auto">
                            <img
                                src="/images/team-rocket.webp"
                                alt=""
                                class="object-contain w-56 h-auto"
                            />
                        </div>
                        <h2 class="mt-6">Pokemon Not Found</h2>
                        <p>
                            Not even Team Rocket can find the cards you are
                            looking for. Click reset, or try a different search.
                        </p>
                    </div>

                    <div
                        v-else
                        class="grid grid-cols-2 gap-6 px-4 pt-12 mx-auto sm:px-6 lg:px-8 max-w-7xl sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6"
                    >
                        <Card
                            :card="card"
                            v-for="card in cards.data"
                            :key="card.name"
                            :show-set="true"
                            @show-card="handleShowCardModal"
                        />
                    </div>
                    <div
                        v-if="cards.data && cards.data.length > 0"
                        class="px-4 pb-12 mx-auto sm:px-6 lg:px-8 max-w-7xl"
                    >
                        <!-- Pagination -->
                        <breeze-pagination
                            :pagination="cards"
                            @previous="handlePagination('prev')"
                            @next="handlePagination('next')"
                        />
                    </div>

                    <!-- Mobile Modal -->
                    <breeze-modal
                        :open="showCardModal"
                        @close="handleShowCardModalClose"
                        class="block bg-opacity-25 md:hidden"
                    >
                        <div class="h-full">
                            <div
                                class="flex items-center justify-center w-auto h-full"
                            >
                                <img
                                    :src="activeModalCard.image_large"
                                    class="object-contain w-auto h-full sm:h-120"
                                    loading="lazy"
                                />
                            </div>
                        </div>
                    </breeze-modal>

                    <!-- Desktop Modal -->
                    <breeze-modal
                        :open="showCardModal"
                        @close="handleShowCardModalClose"
                        transparent-bg
                        hide-close
                        class="hidden bg-opacity-25 md:block"
                    >
                        <div class="h-full">
                            <div
                                class="flex items-center justify-center w-auto h-full"
                            >
                                <img
                                    :src="activeModalCard.image_large"
                                    class="object-contain w-auto h-full sm:h-120"
                                    loading="lazy"
                                />
                            </div>
                        </div>
                    </breeze-modal>
                </div>
            </div>
        </breeze-layout>

        <fixed-donate-bar />
    </div>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeModal from "@/Components/Modal";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import BreezeInput from "@/Components/Input";
    import BreezeButton from "@/Components/Button";
    import Card from "@/Components/Card";
    import BreezePagination from "@/Components/Pagination";
    import FixedDonateBar from "@/Components/FixedDonateBar";

    export default {
        components: {
            BreezeLayout,
            BreezeModal,
            SearchIcon,
            BreezeInput,
            BreezeButton,
            Card,
            BreezePagination,
            FixedDonateBar,
        },
        props: {
            cards: Object,
            topPokemon: Array,
        },
        data() {
            return {
                form: this.$inertia.form({
                    query: "",
                }),
                formSubmitted: false,
                showCardModal: false,
                activeModalCard: null,
            };
        },
        computed: {
            formattedCards() {
                return this.cards.data;
            },
        },
        methods: {
            handleSidebarSearch(pokemon) {
                const query = pokemon.toLowerCase();
                this.form.query = query;
                this.submitSearch();
            },
            submitSearch() {
                this.$inertia.get("/cards", {
                    query: this.form.query,
                    preserveState: true,
                    preserveScroll: true,
                    onFinish: () => {
                        this.formSubmitted = true;
                    },
                });
            },
            resetSearch() {
                this.form.get("/cards", {
                    params: {
                        query: null,
                    },
                    preserveScroll: true,
                    preserveState: false,
                    onFinish: () => {
                        this.form.query = null;
                    },
                });
            },
            handlePagination(direction) {
                const endpoint =
                    direction === "next"
                        ? this.cards.next_page_url
                        : this.cards.prev_page_url;
                this.$inertia.get(endpoint);
            },
            handleShowCardModal(card) {
                this.activeModalCard = card;
                this.showCardModal = true;
            },
            handleShowCardModalClose() {
                this.activeModalCard = null;
                this.showCardModal = false;
            },
        },
    };
</script>

<style scoped>
    .sidebar {
        height: calc(100vh - 4rem);
    }
</style>
