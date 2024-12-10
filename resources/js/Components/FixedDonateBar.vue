<template>
    <div>
        <div
            class="fixed right-0 z-20 p-2 pb-3 pr-3 bg-white border-t-2 border-b-2 border-l-2 shadow-2xl bottom-32 sm:bottom-32 border-lightBlue">
            <p class="text-sm font-bold text-left text-darkBlue">Donate</p>
            <div class="flex flex-col items-start justify-center">
                <breeze-button @click.prevent="handleDonateModal('paypal')" class="w-auto mt-2" width="auto" size="auto"
                    color="paypal">
                    <paypal-icon class="w-6 h-6" />
                </breeze-button>
                <breeze-button @click.prevent="handleDonateModal('venmo')" class="w-auto mt-2" width="auto" size="auto"
                    color="venmo">
                    <venmo-icon class="w-6 h-6" />
                </breeze-button>
                <breeze-button @click.prevent="handleDonateModal('cashapp')" class="w-auto mt-2" width="auto"
                    size="auto" color="cashapp">
                    <cashapp-icon class="w-6 h-6" />
                </breeze-button>
            </div>
        </div>

        <donate-modal :show-modal="showDonateModal" @close="handleCloseModal" :type="donateModalType" />
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    import DonateModal from "@/Components/DonateModal";

    import PaypalIcon from "@/Components/Icons/PaypalIcon";
    import VenmoIcon from "@/Components/Icons/VenmoIcon";
    import CashappIcon from "@/Components/Icons/CashappIcon";

    export default {
        components: {
            BreezeButton,
            DonateModal,
            // Icons
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
