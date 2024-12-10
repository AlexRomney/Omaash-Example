<template>
    <div>
        <submission-lookup v-if="!auth.user" />
        <how-it-works :auth="auth" />
        <pricing :prices="prices" :auctionCompanies="auctionCompanies" />
        <pricing-estimator :companies="companies" />
        <submission-lookup v-if="auth.user" />
    </div>
</template>

<script>
    import HowItWorks from "@/Components/middleman/HowItWorks";
    import Pricing from "@/Components/middleman/Pricing";
    import PricingEstimator from "@/Components/middleman/PricingEstimator";
    import SubmissionLookup from "@/Components/middleman/SubmissionLookup";

    export default {
        props: {
            prices: {
                type: Object,
                required: true,
            },
            auth: {
                type: Object,
                required: true,
            },
            companies: {
                type: Object,
                required: true,
            },
            auctionCompanies: {
                type: Object,
                required: true
            }
        },
        components: {
            HowItWorks,
            Pricing,
            PricingEstimator,
            SubmissionLookup,
        },
    };
</script>
