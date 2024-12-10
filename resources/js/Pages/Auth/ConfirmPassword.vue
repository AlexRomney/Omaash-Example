<template>
    <breeze-layout bg-class="bg-auth">
        <template #header>
            <h2 class="text-2xl text-center text-white sm:text-4xl">
                Confirm Password
            </h2>
        </template>
        <section class="px-4 pb-64 -mt-8 sm:-mt-12 sm:px-6 lg:px-8">
            <div
                class="w-full px-6 py-6 mx-auto overflow-hidden bg-white shadow-lg sm:max-w-md"
            >
                <div class="mb-4 text-sm">
                    This is a secure area of the application. Please confirm
                    your password before continuing.
                </div>

                <breeze-validation-errors class="mb-6" />

                <form @submit.prevent="submit">
                    <div>
                        <breeze-label for="password" value="Password" />
                        <breeze-input
                            ref="password"
                            id="password"
                            type="password"
                            class="block w-full mt-1"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                    </div>

                    <div class="flex justify-end mt-6">
                        <breeze-button
                            color="darkBlue"
                            class="w-full sm:w-auto"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Confirm
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
                    password: "",
                }),
            };
        },

        mounted() {
            this.$refs.password.focus();
        },

        methods: {
            submit() {
                this.form.post(this.route("password.confirm"), {
                    onFinish: () => this.form.reset(),
                });
            },
        },
    };
</script>
