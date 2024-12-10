<template>
    <breeze-layout bg-class="bg-middleman">
        <template #header>
            <h2 class="text-4xl text-left text-white">New Submission</h2>
        </template>

        <navigation v-if="auth.user" active-tab="form" />

        <new-submission :companies="companies" :auctionCompanies="auctionCompanies" />
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Landing from "@/Components/middleman/Landing";
    import Navigation from "@/Components/middleman/Navigation";
    import NewSubmission from "@/Components/middleman/NewSubmission";

    export default {
        components: {
            BreezeLayout,
            Landing,
            Navigation,
            NewSubmission,
        },
        props: {
            auth: Object,
            companies: Object,
            auctionCompanies: Object,
        },
    };
</script>
