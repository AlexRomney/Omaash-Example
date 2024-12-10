<template>
    <div>
        <breeze-layout>
            <template #header>
                <h2 class="text-4xl text-center text-white">
                    Welcome to the Omaash Nation
                </h2>
            </template>

            <section class="py-12 sm:py-24">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                        <div>
                            <h3 class="text-3xl">About Omaash</h3>
                            <p class="mt-4">
                                Ever since I was a kid, I have loved collecting.
                                Whether it was my random knife collection,
                                rocks, or Pokemon cards it always felt good to
                                keep things nice and organized. When I
                                discovered Pokemon cards again back in 2018 my
                                childhood came rushing back and the nostalgia
                                hit hard. I wanted to share the joys of opening
                                packs with the world, and this is where my
                                YouTube journey began! I love being part of such
                                an amazing community and hope to keep on growing
                                and enjoying the nerdy, nostalgic things in life
                                together. Thanks for being part of Omaash
                                Nation!
                            </p>
                        </div>
                        <div class="flex flex-col items-start justify-center">
                            <h4 class="text-2xl text-lightBlue">
                                All Out Nerd!
                            </h4>
                            <ul class="mt-4 space-y-4">
                                <li class="flex items-center">
                                    <breeze-button
                                        class="w-auto cursor-default"
                                        width="auto"
                                        size="auto"
                                        :no-click="true"
                                        ><grin-shiny-icon class="w-5 h-auto" />
                                    </breeze-button>
                                    <span
                                        class="ml-4 font-bungee text-lightBlue"
                                        >Collectible Enthusiast</span
                                    >
                                </li>
                                <li class="flex items-center">
                                    <breeze-button
                                        class="w-auto cursor-default"
                                        width="auto"
                                        size="auto"
                                        :no-click="true"
                                        ><content-creator-icon
                                            class="w-5 h-auto"
                                        />
                                    </breeze-button>
                                    <span
                                        class="ml-4 font-bungee text-lightBlue"
                                        >Anime Lover</span
                                    >
                                </li>
                                <li class="flex items-center">
                                    <breeze-button
                                        class="w-auto cursor-default"
                                        width="auto"
                                        size="auto"
                                        :no-click="true"
                                        ><pizza-icon class="w-5 h-auto" />
                                    </breeze-button>
                                    <span
                                        class="ml-4 font-bungee text-lightBlue"
                                        >Foodie!</span
                                    >
                                </li>
                                <li class="flex items-center">
                                    <breeze-button
                                        class="w-auto cursor-default"
                                        width="auto"
                                        size="auto"
                                        :no-click="true"
                                        ><volleyball-icon class="w-5 h-auto" />
                                    </breeze-button>
                                    <span
                                        class="ml-4 font-bungee text-lightBlue"
                                        >Volleyball Player</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 sm:py-24 bg-lightGray">
                <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                    <div class="max-w-2xl mx-auto">
                        <h3 class="text-3xl">Middleman Service</h3>
                        <p class="mt-4">
                            Let's get your collections professionally graded and
                            protected forever! The Omaash Middleman Service
                            makes the process easy and fun.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 gap-12 mt-16 md:grid-cols-3">
                        <div class="relative px-4 py-6 bg-white shadow-lg">
                            <div class="absolute inset-x-0 -top-6">
                                <breeze-button
                                    class="mx-auto"
                                    width="auto"
                                    size="auto"
                                    :no-click="true"
                                    color="darkBlue"
                                    ><div
                                        class="w-6 h-6 text-xl align-middle font-bungee"
                                    >
                                        1
                                    </div>
                                </breeze-button>
                            </div>
                            <h4 class="mt-6">Decision Time</h4>
                            <p class="mt-3">
                                Pick and prepare the cards you want graded and if you want 
                                them returned or auctioned off.
                            </p>
                        </div>
                        <div class="relative px-4 py-6 bg-white shadow-lg">
                            <div class="absolute inset-x-0 -top-6">
                                <breeze-button
                                    class="mx-auto"
                                    width="auto"
                                    size="auto"
                                    :no-click="true"
                                    color="darkBlue"
                                    ><div
                                        class="w-6 h-6 text-xl align-middle font-bungee"
                                    >
                                        2
                                    </div>
                                </breeze-button>
                            </div>
                            <h4 class="mt-6">The Send Off</h4>
                            <p class="mt-3">
                                Send your cards to me, I send them to the
                                grading company, and then we wait...
                            </p>
                        </div>
                        <div class="relative px-4 py-6 bg-white shadow-lg">
                            <div class="absolute inset-x-0 -top-6">
                                <breeze-button
                                    class="mx-auto"
                                    width="auto"
                                    size="auto"
                                    :no-click="true"
                                    color="darkBlue"
                                    ><div
                                        class="w-6 h-6 text-xl align-middle font-bungee"
                                    >
                                        3
                                    </div>
                                </breeze-button>
                            </div>
                            <h4 class="mt-6">Jump For Joy!</h4>
                            <p class="mt-3">
                                Get your cards or cash back. It's as simple as that!
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 sm:py-24">
                <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                    <div class="max-w-2xl mx-auto">
                        <h3 class="text-3xl">Show some love!</h3>
                        <p class="mt-4">
                            Support Omaash by subscribing to my YouTube channel
                            where I reveal your cards live!
                        </p>
                        <div
                            class="flex flex-col items-center justify-center mt-6 sm:space-x-6 sm:flex-row"
                        >
                            <a
                                href="https://youtube.com/omaash"
                                target="_blank"
                            >
                                <breeze-button color="youtube">
                                    Youtube
                                </breeze-button>
                            </a>
                        </div>
                    </div>

                    <div class="max-w-2xl mx-auto mt-12">
                        <h3 class="text-xl">Donate Now</h3>
                        <div
                            class="flex items-center justify-center mt-6 space-x-6"
                        >
                            <breeze-button
                                @click.prevent="handleDonateModal('venmo')"
                                class="w-auto"
                                width="auto"
                                size="auto"
                                color="venmo"
                                ><venmo-icon class="w-6 h-6"
                            /></breeze-button>
                            <breeze-button
                                @click.prevent="handleDonateModal('paypal')"
                                class="w-auto"
                                width="auto"
                                size="auto"
                                color="paypal"
                                ><paypal-icon class="w-6 h-6"
                            /></breeze-button>
                            <breeze-button
                                @click.prevent="handleDonateModal('cashapp')"
                                class="w-auto"
                                width="auto"
                                size="auto"
                                color="cashapp"
                                ><cashapp-icon class="w-6 h-6"
                            /></breeze-button>
                        </div>
                    </div>
                </div>
            </section>
        </breeze-layout>
        <donate-modal
            :show-modal="showDonateModal"
            @close="handleCloseModal"
            :type="donateModalType"
        />
    </div>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeButton from "@/Components/Button";
    import DonateModal from "@/Components/DonateModal";

    // Icons
    import GrinShinyIcon from "@/Components/Icons/GrinShinyIcon";
    import ContentCreatorIcon from "@/Components/Icons/ContentCreatorIcon";
    import PizzaIcon from "@/Components/Icons/PizzaIcon";
    import VolleyballIcon from "@/Components/Icons/VolleyballIcon";

    import PaypalIcon from "@/Components/Icons/PaypalIcon";
    import VenmoIcon from "@/Components/Icons/VenmoIcon";
    import CashappIcon from "@/Components/Icons/CashappIcon";

    export default {
        components: {
            BreezeLayout,
            BreezeButton,
            DonateModal,
            // Icons
            GrinShinyIcon,
            ContentCreatorIcon,
            PizzaIcon,
            VolleyballIcon,
            PaypalIcon,
            VenmoIcon,
            CashappIcon,
        },
        data() {
            return {
                showDonateModal: false,
                donateModalType: "venmo",
            };
        },
        methods: {
            handleDonateModal(paymentMethod) {
                this.donateModalType = paymentMethod;
                this.showDonateModal = true;
            },
            handleCloseModal() {
                this.showDonateModal = false;
            },
        },
    };
</script>
