<template>
    <breeze-layout :hide-nav="true" :hide-footer="true">
        <template #header>
            <div class="flex flex-col items-center justify-center sm:flex-row">
                <div class="w-20 h-20 sm:w-40 sm:h-40">
                    <img
                        class="object-contain w-full h-full"
                        :src="pokemonSprite"
                        alt=""
                    />
                </div>
                <h2
                    class="text-2xl text-center text-white sm:text-left sm:text-4xl"
                >
                    {{ submission.sub_id }} Printout
                </h2>
            </div>
        </template>

        <div
            class="px-4 py-6 mx-auto sm:-mt-32 sm:py-24 max-w-7xl sm:px-6 lg:px-8"
        >
            <div
                class="w-full max-w-4xl px-4 py-4 mx-auto sm:py-12 sm:px-6 lg:px-8 bg-medGray"
            >
                <div class="mx-auto mb-8 no-print">
                    <div
                        class="mb-12 md:flex md:items-center md:justify-between"
                    >
                        <inertia-link
                            :href="this.route('middleman/submissions')"
                        >
                            <breeze-button
                                class="cursor-pointer"
                                :no-click="true"
                                size="small"
                                >Back to Submissions</breeze-button
                            >
                        </inertia-link>
                        <div
                            v-if="submission.expedited"
                            class="px-8 py-2 mt-4 text-lg tracking-wider text-center border-4 md:mt-0 text-youtube border-youtube font-bungee stamp"
                        >
                            Expedited
                        </div>
                    </div>
                    <h4 class="text-2xl sm:text-3xl text-lightBlue">
                        Print Information
                    </h4>
                    <p class="mt-2">
                        Print this page and send with the cards you are
                        submitting. Depending on your browser, go to File >
                        Print, or by pressing the command (CMD) plus "P" key on
                        your keyboard to open the print dialog.
                    </p>
                    <breeze-alert
                        class="mt-4"
                        type="error"
                        title="Please make sure all this info is correct before
                        sending. If any information is inaccurate please update
                        on your profile page."
                    >
                    </breeze-alert>
                </div>

                <div class="mt-8 mb-8">
                    <div>
                        <h3>{{ user.first_name }} {{ user.last_name }}</h3>
                        <p>{{ user.contact_handle }}</p>
                    </div>
                    <dl
                        class="grid grid-cols-1 mt-12 text-sm text-gray-600 sm:grid-cols-2 gap-x-4"
                    >
                        <div>
                            <dt class="text-lightBlue font-bungee">
                                Return Shipping Address
                            </dt>
                            <dd
                                v-if="user.shipping_type === 'states'"
                                class="mt-2"
                            >
                                <address class="not-italic">
                                    <span class="block">{{
                                        user.address
                                    }}</span>
                                    <span class="block">{{
                                        addressLine2
                                    }}</span>
                                </address>
                            </dd>
                            <dd v-else class="mt-2">
                                <address class="not-italic">
                                    <span class="block">{{
                                        user.international_address
                                    }}</span>
                                </address>
                            </dd>
                        </div>
                        <div class="mt-6 sm:mt-0">
                            <dt class="text-lightBlue font-bungee">
                                Payment & Contact Type
                            </dt>
                            <dd class="mt-2">
                                <p class="block">
                                    {{ $filters.uppercase(user.payment_type) }}
                                </p>
                                <p class="block">
                                    {{ $filters.uppercase(user.contact_type) }}
                                </p>
                            </dd>
                        </div>
                    </dl>
                </div>

                <dl class="font-bold divide-y divide-lightGray">
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Submission ID
                        </dt>
                        <dd
                            class="min-w-0 truncate text-darkGray"
                            style="direction: rtl"
                        >
                            {{ submission.sub_id }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Company
                        </dt>
                        <dd class="text-darkGray">
                            {{ $filters.allCaps(submission.company) }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Service Level
                        </dt>
                        <dd class="text-darkGray">
                            {{ $filters.uppercase(submission.service_level) }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Number of Cards
                        </dt>
                        <dd class="text-darkGray">
                            {{ $filters.number(submission.number_of_cards) }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Needs Card Savers
                        </dt>
                        <dd class="text-darkGray">
                            {{
                                $filters.booleanYesNo(
                                    submission.needs_card_savers
                                )
                            }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Grading Fee
                        </dt>
                        <dd class="text-darkGray">
                            ${{ $filters.number(submission.grading_fee) }}
                        </dd>
                    </div>
                    <div v-if="submission.auction_off" class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Auction
                        </dt>
                        <dd class="text-darkGray">
                            {{ submission.auction_company }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Omaash Fee
                        </dt>
                        <dd class="text-darkGray">
                            ${{ $filters.number(submission.my_fee) }}
                        </dd>
                    </div>
                    <div
                        v-if="submission.card_saver_fee"
                        class="flex justify-between py-2"
                    >
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Card Saver Fee
                        </dt>
                        <dd class="text-darkGray">
                            ${{ $filters.number(submission.card_saver_fee) }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Total
                        </dt>
                        <dd class="text-darkGray">${{ total }}</dd>
                    </div>
                    <div
                        v-if="submission.note"
                        class="flex justify-between py-2"
                    >
                        <dt class="pr-4 text-darkBlue whitespace-nowrap">
                            Note
                        </dt>
                        <dd
                            class="leading-tight text-darkGray"
                            style="direction: rtl"
                        >
                            {{ submission.note }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeAlert from "@/Components/Alert";
    import BreezeButton from "@/Components/Button";

    import Landing from "@/Components/middleman/Landing";
    import Navigation from "@/Components/middleman/Navigation";
    import NewSubmission from "@/Components/middleman/NewSubmission";

    export default {
        components: {
            BreezeLayout,
            BreezeAlert,
            BreezeButton,
            Landing,
            Navigation,
            NewSubmission,
        },
        props: {
            submission: {
                type: Object,
                required: true,
            },
            user: Object,
            pokemonSprite: String,
        },
        computed: {
            addressLine2() {
                let user = this.user;
                return `${user.city}, ${user.state} ${user.zip}`;
            },
            total() {
                let submission = this.submission;
                const total =
                    submission.grading_fee +
                    submission.my_fee +
                    submission.card_saver_fee;
                return this.$filters.number(total);
            },
        },
    };
</script>

<style>
    @media print {
        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
