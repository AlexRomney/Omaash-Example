<template>
    <breeze-layout bg-class="bg-middleman">
        <template #header>
            <h2 class="text-4xl text-left text-white">Middleman</h2>
        </template>

        <navigation v-if="auth.user" active-tab="home" />

        <landing :prices="prices" :companies="companies" :auth="auth" :auctionCompanies="auctionCompanies"
            key="logged-out" />
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Landing from "@/Components/middleman/Landing";
    import Navigation from "@/Components/middleman/Navigation";

    export default {
        components: {
            BreezeLayout,
            Landing,
            Navigation,
        },
        props: {
            prices: Object,
            auth: Object,
            companies: Object,
            auctionCompanies: Object,
        },
    };
</script>
