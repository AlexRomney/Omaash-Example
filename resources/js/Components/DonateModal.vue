<template>
    <breeze-modal :open="showModal" @close="handleCloseModal">
        <div class="flex flex-col items-center justify-center sm:items-start sm:flex-row">
            <div class="flex-shrink-0 w-40 h-auto">
                <img :src="`/images/payment-methods/${imageUrl}`" alt="" class="object-contain w-40 h-auto" />
            </div>
            <div class="mt-6 ml-6 sm:mt-0">
                <h2 class="text-2xl" :class="headingText">
                    Contribute to Omaash!
                </h2>
                <p class="mt-2">
                    Enjoying your time on the site? Show some extra love by
                    contributing to the Omaash Nation through {{ $filters.uppercase(type) }}.
                    Scan the QR code on the left and follow the on-screen instructions to complete your
                    donation. Thanks for supporting Omaash!
                </p>
            </div>
        </div>
    </breeze-modal>
</template>

<script>
    import BreezeModal from "@/Components/Modal";
    import BreezeButton from "@/Components/Button";

    export default {
        components: {
            BreezeModal,
            BreezeButton,
        },
        props: {
            showModal: {
                type: Boolean,
                required: true,
                default: () => false,
            },
            type: {
                type: String,
                required: true,
                default: () => "venmo",
                validator: (value) =>
                    ["paypal", "venmo", "cashapp"].includes(value),
            },
        },
        computed: {
            imageUrl() {
                switch (this.type) {
                    case "paypal":
                        return "paypal-qrcode.jpg";
                    case "venmo":
                        return "venmo-qrcode.jpg";
                    case "cashapp":
                        return "cashapp-qrcode.jpg";
                    default:
                        return "venmo-qrcode.jpg";
                }
            },
            headingText() {
                switch (this.type) {
                    case "paypal":
                        return "text-paypal";
                    case "venmo":
                        return "text-venmo";
                    case "cashapp":
                        return "text-cashapp";
                    default:
                        return "text-venmo";
                }
            },
        },
        methods: {
            handleCloseModal() {
                this.$emit("close");
            },
        },
    };
</script>
