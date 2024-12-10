<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Register for your Omaash Nation account
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm:-mt-16 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
                <breeze-validation-errors class="mb-6" />

                <form @submit.prevent="submit">
                    <div>
                        <breeze-label for="username" value="Username" />
                        <breeze-input
                            ref="username"
                            id="username"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.username"
                            required
                            autocomplete="username"
                        />
                    </div>

                    <div class="mt-4">
                        <breeze-label for="email" value="Email" />
                        <breeze-input
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

                    <div
                        class="flex flex-col flex-col-reverse items-center mt-6 sm:flex-row sm:items-center sm:justify-end"
                    >
                        <inertia-link
                            :href="route('login')"
                            class="mt-6 text-sm underline font-bungee text-darkGray hover:text-lightBlue sm:mt-0"
                        >
                            Already registered?
                        </inertia-link>

                        <breeze-button
                            class="w-full sm:ml-4 sm:w-auto"
                            color="darkBlue"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
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

        data() {
            return {
                form: this.$inertia.form({
                    username: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    terms: false,
                }),
            };
        },

        mounted() {
            this.$refs.username.focus();
        },

        methods: {
            submit() {
                this.form.post(this.route("register"), {
                    onFinish: () =>
                        this.form.reset("password", "password_confirmation"),
                });
            },
        },
    };
</script>
