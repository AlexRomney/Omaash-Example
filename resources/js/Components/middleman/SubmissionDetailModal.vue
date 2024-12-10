<template>
    <breeze-modal :open="showModal" @close="handleCloseModal">
        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-xl">Submission Status</h2>
            <div
                v-if="activeSubmission.expedited"
                class="px-4 py-1 mt-4 tracking-wider text-center border-4 md:mt-0 text-youtube border-youtube font-bungee stamp"
            >
                Expedited
            </div>
        </div>

        <submission-progress
            :statuses="statuses"
            :current-status="activeSubmission.status"
        />

        <div class="mt-12">
            <h3 class="text-xl">Submission Summary</h3>

            <dl class="pt-6 font-bold divide-y divide-lightGray">
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Submission ID
                    </dt>
                    <dd
                        class="min-w-0 truncate text-darkGray"
                        style="direction: rtl"
                    >
                        {{ activeSubmission.sub_id }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Company
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.allCaps(activeSubmission.company) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Service Level
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.uppercase(activeSubmission.service_level) }}
                    </dd>
                </div>
                <div v-if="activeSubmission.auction_off" class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Auction Company
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.uppercase(activeSubmission.auction_company) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Number of Cards
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.number(activeSubmission.number_of_cards) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Grading Fee
                    </dt>
                    <dd class="text-darkGray">
                        ${{ $filters.number(activeSubmission.grading_fee) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Omaash Fee
                    </dt>
                    <dd class="text-darkGray">
                        ${{ $filters.number(activeSubmission.my_fee) }}
                    </dd>
                </div>
                <div
                    v-if="activeSubmission.shipping_fee"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Shipping Fee
                    </dt>
                    <dd class="text-darkGray">
                        ${{ $filters.number(activeSubmission.shipping_fee) }}
                    </dd>
                </div>
                <div
                    v-if="activeSubmission.card_saver_fee"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Card Saver Fee
                    </dt>
                    <dd class="text-darkGray">
                        ${{ $filters.number(activeSubmission.card_saver_fee) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">Total</dt>
                    <dd class="text-darkGray">${{ total }}</dd>
                </div>
                <div
                    v-if="activeSubmission.completed"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Completed
                    </dt>
                    <dd class="text-darkGray">
                        {{ activeSubmission.completed ? "Yes" : "No" }}
                    </dd>
                </div>
                <div
                    v-if="activeSubmission.completed_date"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Completed Date
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.date(activeSubmission.completed_date) }}
                    </dd>
                </div>
                <div
                    v-if="activeSubmission.send_off_date"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Send Off Date
                    </dt>
                    <dd class="text-darkGray">
                        {{ $filters.date(activeSubmission.send_off_date) }}
                    </dd>
                </div>
                <div class="flex justify-between py-2 sm:px-4 md:px-6">
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Sub Creation Date
                    </dt>
                    <dd class="text-darkGray">
                        {{
                            $filters.dateTimestamp(activeSubmission.created_at)
                        }}
                    </dd>
                </div>
                <div
                    v-if="activeSubmission.tracking_number"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Tracking Number
                    </dt>
                    <dd class="text-darkGray">
                        {{ activeSubmission.tracking_number }}
                    </dd>
                </div>
            </dl>

            <div class="flex items-center justify-between mt-6">
                <div
                    class="flex items-center justify-center flex-shrink-0 mr-2 md:mr-4"
                >
                    <img
                        class="object-contain w-16 h-16 mx-auto bg-center lg:w-24 lg:h-24"
                        loading="lazy"
                        :src="activeSubmission.pokemonSprite"
                    />
                </div>
                <a
                    :href="`/middleman/submission-printout/${activeSubmission.sub_id}`"
                    target="_blank"
                    class="cursor-pointer"
                >
                    <breeze-button
                        :no-click="true"
                        size="small"
                        color="darkBlue"
                        class="w-full cursor-pointer sm:w-auto"
                    >
                        <span class="hidden sm:inline-block">Submission</span>
                        Printout</breeze-button
                    >
                </a>
            </div>
        </div>
    </breeze-modal>
</template>

<script>
    import BreezeModal from "@/Components/Modal";
    import BreezeButton from "@/Components/Button";
    import SubmissionProgress from "@/Components/middleman/SubmissionProgress";

    export default {
        components: {
            BreezeModal,
            BreezeButton,
            SubmissionProgress,
        },
        props: {
            showModal: {
                type: Boolean,
                required: true,
                default: () => false,
            },
            activeSubmission: {
                type: Object,
                required: false,
            },
            statuses: {
                type: Array,
                required: false,
            },
        },
        methods: {
            handleCloseModal() {
                this.$emit("close");
            },
        },
        computed: {
            total() {
                let submission = this.activeSubmission;
                return (
                    submission.grading_fee +
                    submission.my_fee +
                    submission.shipping_fee +
                    submission.card_saver_fee
                );
            },
        },
    };
</script>

<style>
    .stamp {
        -webkit-mask-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png");
        -webkit-mask-size: 800px 400px;
        -webkit-mask-position: 1rem 2rem;
        mix-blend-mode: multiply;
    }
</style>
