<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Login to your Omaash Nation account
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm:-mt-12 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
                <breeze-validation-errors class="mb-6" />

                <breeze-alert
                    v-show="status"
                    title="Status"
                    :description="status"
                    type="success"
                    class="mb-6"
                />

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

                    <div class="mt-4">
                        <breeze-label for="password" value="Password" />
                        <breeze-input
                            id="password"
                            type="password"
                            class="block w-full mt-1"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                    </div>

                    <div
                        class="flex flex-col flex-col-reverse items-center mt-6 sm:flex-row sm:items-center sm:justify-end"
                    >
                        <inertia-link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="mt-6 text-sm underline font-bungee text-darkGray hover:text-lightBlue sm:mt-0"
                        >
                            Forgot your password?
                        </inertia-link>

                        <breeze-button
                            color="darkBlue"
                            class="w-full sm:ml-4 sm:w-auto"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
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
            auth: Object,
            canResetPassword: Boolean,
            errors: Object,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: "",
                    password: "",
                }),
            };
        },

        mounted() {
            this.$refs.email.focus();
        },

        methods: {
            submit() {
                this.form
                    .transform((data) => ({
                        ...data,
                    }))
                    .post(this.route("login"), {
                        onFinish: () => this.form.reset("password"),
                    });
            },
        },
    };
</script>
