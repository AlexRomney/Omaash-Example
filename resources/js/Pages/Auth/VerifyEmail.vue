<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Reset Password
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm-mt-16 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
                <div class="mb-6 text-sm">
                    Thanks for signing up! Before getting started, could you
                    verify your email address by clicking on the link we just
                    emailed to you? If you didn't receive the email, we will
                    gladly send you another.
                </div>

                <breeze-alert
                    v-if="verificationLinkSent"
                    title="Verification Link Sent"
                    description=" A new verification link has been sent to the email address
                    you provided during registration."
                    type="success"
                    class="mb-6"
                />

                <form @submit.prevent="submit">
                    <div class="flex items-center justify-between">
                        <breeze-button
                            color="darkBlue"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Resend Verification Email
                        </breeze-button>

                        <inertia-link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-sm underline font-bungee text-darkGray hover:text-lightBlue"
                            >Log Out</inertia-link
                        >
                    </div>
                </form>
            </div>
        </section>
    </breeze-layout>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeAlert from "@/Components/Alert";

    export default {
        components: {
            BreezeButton,
            BreezeLayout,
            BreezeAlert,
        },

        props: {
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form(),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route("verification.send"));
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === "verification-link-sent";
            },
        },
    };
</script>
