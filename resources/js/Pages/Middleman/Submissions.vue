<template>
    <breeze-layout bg-class="bg-middleman">
        <template #header>
            <h2 class="text-4xl text-left text-white">My Submissions</h2>
        </template>

        <navigation v-if="auth.user" active-tab="submissions" />

        <submissions :submissions="submissions" :statuses="statuses" />
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Landing from "@/Components/middleman/Landing";
    import Navigation from "@/Components/middleman/Navigation";
    import Submissions from "@/Components/middleman/Submissions";

    export default {
        components: {
            BreezeLayout,
            Landing,
            Navigation,
            Submissions,
        },
        props: {
            auth: Object,
            submissions: Object,
            statuses: Array,
        },
    };
</script>
