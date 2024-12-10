<template>
    <breeze-layout bg-class="bg-admin">
        <template #header>
            <h2 class="text-4xl text-center text-white">Admin Submissions</h2>
        </template>

        <navigation active-tab="submissions" />

        <submissions :submissions="submissions" />
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Navigation from "@/Components/Admin/Navigation";
    import Submissions from "@/Components/Admin/Submissions";

    export default {
        components: {
            BreezeLayout,
            Navigation,
            Submissions,
        },
        props: {
            submissions: Object,
        },
    };
</script>
