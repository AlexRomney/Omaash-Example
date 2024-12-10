<template>
    <div>
        <div
            class="hidden max-w-5xl px-4 mx-auto md:block sm:px-6 lg:px-8 md:-mt-8"
        >
            <div
                class="gap-2 px-4 py-4 mx-auto md:grid md:gap-12 md:shadow-lg md:grid-cols-3 bg-lightGray sm:px-6 lg:px-8"
            >
                <inertia-link :href="route('middleman/home')">
                    <breeze-button
                        class="whitespace-nowrap"
                        width="full"
                        size="small"
                        :color="activeTab === 'home' ? 'darkBlue' : 'darkGray'"
                        >Home</breeze-button
                    >
                </inertia-link>
                <inertia-link :href="route('middleman/submissions')">
                    <breeze-button
                        class="whitespace-nowrap"
                        width="full"
                        size="small"
                        :color="
                            activeTab === 'submissions'
                                ? 'darkBlue'
                                : 'darkGray'
                        "
                        >Submissions</breeze-button
                    >
                </inertia-link>
                <inertia-link :href="route('middleman/new-submission')">
                    <breeze-button
                        class="whitespace-nowrap"
                        width="full"
                        size="small"
                        :color="activeTab === 'form' ? 'darkBlue' : 'darkGray'"
                        >New Submission</breeze-button
                    >
                </inertia-link>
            </div>
        </div>
        <div class="block w-full px-4 py-8 md:hidden sm:px-6 lg:px-8">
            <select
                @change="handleChange"
                id="tabs"
                name="tabs"
                class="w-full form-input"
            >
                <option value="/" :selected="activeTab === 'home'">Home</option>
                <option
                    value="submissions"
                    :selected="activeTab === 'submissions'"
                >
                    Submissions
                </option>
                <option value="form" :selected="activeTab === 'form'">
                    New Submissions
                </option>
            </select>
        </div>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";

    export default {
        props: {
            activeTab: {
                type: String,
                default: () => "home",
            },
        },
        components: {
            BreezeButton,
        },
        methods: {
            handleChange(event) {
                this.$inertia.visit(`/middleman/${event.target.value}`, {
                    preserveState: true,
                });
            },
        },
    };
</script>
