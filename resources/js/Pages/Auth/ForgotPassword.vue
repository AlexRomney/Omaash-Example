<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Forgot Password
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm:-mt-16 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
                <div class="mb-4 text-sm">
                    Forgot your password? No problem. Just let us know your
                    email address and we will email you a password reset link
                    that will allow you to choose a new one. Please make sure to
                    add
                    <strong class="text-lightBlue"
                        >omaashopenings@gmail.com</strong
                    >
                    to your contacts in order to receive the email.
                </div>

                <breeze-alert
                    v-show="status"
                    title="Status"
                    :description="status"
                    type="success"
                    class="mb-6"
                />

                <breeze-validation-errors class="mb-6" />

                <form @submit.prevent="submit">
                    <div>
                        <breeze-label for="email" value="Email" />
                        <breeze-input
                            ref="email"
                            id="email"
                            type="email"
                            class="block w-full mt-1"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <breeze-button
                            color="darkBlue"
                            class="w-full sm:w-auto"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Email Password Reset Link
                        </breeze-button>
                    </div>
                </form>
            </div>
        </section>
    </breeze-layout>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeAlert from "@/Components/Alert";

    export default {
        components: {
            BreezeButton,
            BreezeLayout,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
            BreezeAlert,
        },

        props: {
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: "",
                }),
            };
        },

        mounted() {
            this.$refs.email.focus();
        },

        methods: {
            submit() {
                this.form.post(this.route("password.email"));
            },
        },
    };
</script>
