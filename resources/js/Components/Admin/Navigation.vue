<template>
    <div>
        <div
            class="hidden max-w-5xl px-4 mx-auto md:block sm:px-6 lg:px-8 md:-mt-8"
        >
            <div
                class="gap-2 px-4 py-4 mx-auto md:grid md:gap-12 md:shadow-lg md:grid-cols-2 bg-lightGray sm:px-6 lg:px-8"
            >
                <inertia-link :href="route('admin/middleman/submissions')">
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
                <inertia-link :href="route('admin/users')">
                    <breeze-button
                        class="whitespace-nowrap"
                        width="full"
                        size="small"
                        :color="activeTab === 'users' ? 'darkBlue' : 'darkGray'"
                        >Users</breeze-button
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
                <option
                    value="submissions"
                    :selected="activeTab === 'submissions'"
                >
                    Submissions
                </option>
                <option value="users" :selected="activeTab === 'users'">
                    Users
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
                default: () => "submissions",
            },
        },
        components: {
            BreezeButton,
        },
        methods: {
            handleChange(event) {
                const url = event.target.value;
                if (url === "home" || url === "submissions") {
                    this.$inertia.visit("/admin/middleman/submissions", {
                        preserveState: true,
                    });
                } else if (url === "users") {
                    this.$inertia.visit("/admin/users", {
                        preserveState: true,
                    });
                }
            },
        },
    };
</script>
