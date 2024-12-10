<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Reset Password
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm:-mt-16 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
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
                            autofocus
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
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="mt-4">
                        <breeze-label
                            for="password_confirmation"
                            value="Confirm Password"
                        />
                        <breeze-input
                            id="password_confirmation"
                            type="password"
                            class="block w-full mt-1"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <breeze-button
                            color="darkBlue"
                            class="w-full sm:w-auto"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Reset Password
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

    export default {
        components: {
            BreezeButton,
            BreezeLayout,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: "",
                    password_confirmation: "",
                }),
            };
        },

        mounted() {
            this.$refs.email.focus();
        },

        methods: {
            submit() {
                this.form.post(this.route("password.update"), {
                    onFinish: () =>
                        this.form.reset("password", "password_confirmation"),
                });
            },
        },
    };
</script>
