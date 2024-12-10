<template>
    <div>
        <breeze-layout
            bg-class="bg-pokemon-cards"
            header-size="small"
            no-pattern
        >
            <template #header>
                <div
                    class="flex flex-col items-center justify-center pt-4 pb-8 sm:pt-8 sm:pb-16"
                >
                    <div class="w-auto h-16 mt-4 sm:h-24">
                        <img
                            :src="setInfo.image_logo"
                            class="object-contain w-full h-full"
                        />
                    </div>
                </div>
            </template>

            <div
                class="mx-auto -mt-4 sm:-mt-8"
                :class="showExtraInfo ? 'max-w-7xl' : 'max-w-5xl'"
            >
                <div class="px-4 py-4 mx-4 bg-white shadow-2xl sm:px-6 lg:px-8">
                    <dl
                        class="grid grid-cols-1 text-center gap-x-4 gap-y-8"
                        :class="columnClass"
                    >
                        <div class="sm:col-span-1">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Symbol
                            </dt>
                            <dd class="mt-1 text-base sm:text-lg">
                                <div class="w-auto h-6 sm:h-8">
                                    <img
                                        :src="setInfo.image_symbol"
                                        class="object-contain w-full h-full"
                                    />
                                </div>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Series
                            </dt>
                            <dd
                                class="mt-1 text-base sm:text-lg text-lightBlue font-bungee"
                            >
                                {{ setInfo.series }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Release Date
                            </dt>
                            <dd
                                class="mt-1 text-base sm:text-lg text-lightBlue font-bungee"
                            >
                                {{ formattedReleaseDate }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1" v-if="showExtraInfo">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Set Total
                            </dt>
                            <dd
                                class="mt-1 text-base sm:text-lg text-lightBlue font-bungee"
                            >
                                {{ setInfo.set_total }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1" v-if="showExtraInfo">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Secret Rares
                            </dt>
                            <dd
                                class="mt-1 text-base sm:text-lg text-lightBlue font-bungee"
                            >
                                {{ setInfo.secret_rares }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt
                                class="text-sm font-medium sm:text-base text-darkGray"
                            >
                                Card Total
                            </dt>
                            <dd
                                class="mt-1 text-base sm:text-lg text-lightBlue font-bungee"
                            >
                                {{ setInfo.card_total }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div
                class="grid grid-cols-2 gap-6 px-4 py-12 mx-auto sm:px-6 lg:px-8 max-w-7xl sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6"
            >
                <Card
                    :card="card"
                    v-for="card in cards"
                    :key="card.name"
                    @show-card="handleShowCardModal"
                />
            </div>

            <!-- Mobile Modal -->
            <breeze-modal
                :open="showCardModal"
                @close="handleShowCardModalClose"
                class="block bg-opacity-25 md:hidden"
            >
                <div class="h-full">
                    <div class="flex items-center justify-center w-auto h-full">
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
                    <div class="flex items-center justify-center w-auto h-full">
                        <img
                            :src="activeModalCard.image_large"
                            class="object-contain w-auto h-full sm:h-120"
                            loading="lazy"
                        />
                    </div>
                </div>
            </breeze-modal>

            <!-- Loader -->
            <full-screen-loader
                :loading="loading"
                :loading-text="`Loading ${setInfo.name} Set`"
            />
        </breeze-layout>

        <fixed-donate-bar v-if="!loading" />
    </div>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Card from "@/Components/Card";
    import BreezeModal from "@/Components/Modal";
    import BreezeButton from "@/Components/Button";
    import FullScreenLoader from "@/Components/FullScreenLoader";
    import FixedDonateBar from "@/Components/FixedDonateBar";

    export default {
        props: {
            cards: Object,
        },
        components: {
            BreezeLayout,
            Card,
            BreezeModal,
            BreezeButton,
            FullScreenLoader,
            FixedDonateBar,
        },
        data() {
            return {
                showCardModal: false,
                activeModalCard: null,
                loading: true,
            };
        },
        mounted() {
            this.loading = true;
            setTimeout(() => {
                this.loading = false;
            }, 2000);
        },
        computed: {
            columnClass() {
                let colClass = this.showExtraInfo
                    ? "sm:grid-cols-6"
                    : "sm:grid-cols-4";
                return colClass;
            },
            showExtraInfo() {
                return this.setInfo.secret_rares > 0;
            },
            setInfo() {
                return this.cards[0].set;
            },
            formattedReleaseDate() {
                let date = new Date(this.setInfo.release_date);
                return date.toLocaleDateString("en-us", {
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                });
            },
        },
        methods: {
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
