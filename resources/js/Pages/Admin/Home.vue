<template>
    <breeze-layout bg-class="bg-admin">
        <template #header>
            <h2 class="text-4xl text-center text-white">Admin Dashboard</h2>
        </template>

        <navigation active-tab="submissions" />
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Navigation from "@/Components/Admin/Navigation";

    export default {
        components: {
            BreezeLayout,
            Navigation,
        },
    };
</script>
