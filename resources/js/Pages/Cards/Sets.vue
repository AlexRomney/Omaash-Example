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
                        <h3 class="text-xl text-left">Jump to set</h3>
                    </div>
                    <sidebar-series-card
                        :series="series"
                        v-for="(series, index) in navSeries"
                        :key="index"
                    />
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
                                        placeholder="Search by set or series name"
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
                                            >Search Sets</span
                                        >
                                    </breeze-button>
                                </div>
                            </form>
                            <div
                                class="flex items-center w-full mt-2 text-sm sm:flex-row"
                            >
                                Want to search by card?
                                <inertia-link
                                    :href="route('cards')"
                                    class="ml-1 underline text-lightBlue"
                                >
                                    Search by Card
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
                        v-if="series.length === 0"
                        class="max-w-xl px-4 py-12 mx-auto text-center sm:px-6 lg:px-8 md:py-24"
                    >
                        <div class="w-56 h-auto mx-auto">
                            <img
                                src="/images/team-rocket.webp"
                                alt=""
                                class="object-contain w-56 h-auto"
                            />
                        </div>
                        <h2>No Sets or Series Found</h2>
                        <p>
                            Not even Team Rocket can find the set you are
                            looking for. Click reset, or try a different search.
                        </p>
                    </div>
                    <div
                        v-else
                        class="grid w-full grid-cols-1 gap-12 py-12 mx-auto max-w-7xl"
                    >
                        <series-card
                            :sets="sets"
                            :series-id="seriesId"
                            v-for="(sets, seriesId, index) in series"
                            :key="index"
                        />
                    </div>
                </div>
            </div>
        </breeze-layout>
        <!-- Fixed Layout -->
        <fixed-donate-bar />
    </div>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import SeriesCard from "@/Components/SeriesCard";
    import SidebarSeriesCard from "@/Components/SidebarSeriesCard";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import BreezeInput from "@/Components/Input";
    import BreezeButton from "@/Components/Button";
    import FixedDonateBar from "@/Components/FixedDonateBar";

    export default {
        components: {
            BreezeLayout,
            SeriesCard,
            SidebarSeriesCard,
            SearchIcon,
            BreezeInput,
            BreezeButton,
            FixedDonateBar,
        },
        props: {
            series: Object,
            navSeries: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    query: null,
                }),
            };
        },
        methods: {
            submitSearch() {
                this.$inertia.get("/cards/sets", {
                    query: this.form.query,
                    preserveScroll: true,
                    onFinish: () => {
                        this.form.query = null;
                    },
                });
            },
            resetSearch() {
                this.form.get("/cards/sets", {
                    params: {
                        query: null,
                    },
                    preserveScroll: true,
                    onFinish: () => {
                        this.form.query = null;
                    },
                });
            },
        },
    };
</script>

<style scoped>
    .sidebar {
        height: calc(100vh - 4rem);
    }
</style>
