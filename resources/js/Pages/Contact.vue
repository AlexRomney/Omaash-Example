<template>
    <breeze-layout bg-class="bg-contact" header-size="small">
        <template #header>
            <h2 class="text-4xl text-center text-white">Contact Me</h2>
        </template>

        <div class="px-4 py-6 mx-auto sm:py-24 max-w-7xl sm:px-6 lg:px-8">
            <div
                class="w-full max-w-2xl px-4 py-6 mx-auto space-y-12 shadow-lg sm:py-12 sm:px-6 lg:px-8 bg-medGray"
            >
                <div class="mx-auto mb-6 text-center">
                    <h4 class="text-2xl sm:text-3xl text-lightBlue">
                        Contact Me
                    </h4>
                    <p class="max-w-md mx-auto mt-2">
                        Send me a DM on the social media platform of your choice
                        or email me through this contact form
                    </p>
                </div>
                <!-- Social -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <a
                        href="https://instagram.com/omaash"
                        class="p-4 bg-white border-4 shadow-lg"
                        style="border-color: #faaa6d"
                        target="_blank"
                    >
                        <breeze-button
                            class="w-full"
                            style="color: #419eae"
                            width="full"
                            size="auto"
                            >Instagram</breeze-button
                        >
                        <div class="w-full h-64 mt-4 opacity-75 md:h-32">
                            <img
                                :src="pokemon[1].official_artwork_url"
                                class="object-contain w-full h-full"
                            />
                        </div>
                    </a>

                    <a
                        href="https://x.com/omaashnation"
                        class="p-4 bg-white border-4 shadow-lg"
                        style="border-color: #84add7"
                        target="_blank"
                    >
                        <breeze-button
                            class="w-full"
                            style="color: #7b675b"
                            width="full"
                            size="auto"
                            >X</breeze-button
                        >
                        <div class="w-full h-64 mt-4 opacity-75 md:h-32">
                            <img
                                :src="pokemon[2].official_artwork_url"
                                class="object-contain w-full h-full"
                            />
                        </div>
                    </a>
                    <a
                        href="https://facebook.com/omaashopenings"
                        class="p-4 bg-white border-4 shadow-lg"
                        style="border-color: #3f9490"
                        target="_blank"
                    >
                        <breeze-button
                            class="w-full"
                            style="color: #e86e7f"
                            width="full"
                            size="auto"
                            >Facebook</breeze-button
                        >
                        <div class="w-full h-64 mt-4 opacity-75 md:h-32">
                            <img
                                :src="pokemon[0].official_artwork_url"
                                class="object-contain w-full h-full"
                            />
                        </div>
                    </a>
                </div>

                <!-- or -->
                <div class="mx-auto text-center">
                    <breeze-button
                        width="auto"
                        size="auto"
                        color="darkGray"
                        :no-click="true"
                    >
                        Or
                    </breeze-button>
                </div>

                <!-- Form -->
                <div>
                    <breeze-validation-errors class="mb-6" />

                    <breeze-alert
                        v-show="status"
                        title="Status"
                        :description="status"
                        type="success"
                        class="mb-6"
                    />

                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <breeze-label for="name" value="Name" />
                                <breeze-input
                                    ref="name"
                                    id="name"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.name"
                                    required
                                />
                            </div>
                            <div>
                                <breeze-label
                                    for="email"
                                    value="Email Address"
                                />
                                <breeze-input
                                    ref="email"
                                    id="email"
                                    type="email"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.email"
                                    required
                                />
                            </div>
                            <div>
                                <breeze-label for="message" value="Message" />
                                <breeze-textarea
                                    ref="message"
                                    id="message"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.message"
                                    required
                                />
                            </div>

                            <div>
                                <div class="relative flex items-center">
                                    <div class="flex items-center h-5">
                                        <breeze-checkbox
                                            id="not-robot"
                                            aria-describedby="not-robot-description"
                                            name="not-robot"
                                            v-model="form.notRobot"
                                            required
                                        />
                                    </div>
                                    <div class="ml-3 leading-snug">
                                        <label
                                            for="not-robot"
                                            class="cursor-pointer select-none text-darkGray"
                                            >I AM NOT A ROBOT</label
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <breeze-input
                            ref="sucker"
                            id="sucker"
                            type="sucker"
                            :no-border="true"
                            class="hidden"
                            :value="form.sucker"
                            required
                        />

                        <div
                            class="flex flex-col-reverse items-center gap-2 mt-12 sm:gap-6 sm:flex-row sm:items-center sm:justify-end"
                        >
                            <breeze-button
                                class="w-full sm:w-auto"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Send Message
                            </breeze-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeCheckbox from "@/Components/Checkbox";
    import BreezeTextarea from "@/Components/Textarea";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeAlert from "@/Components/Alert";
    import InstagramIcon from "@/Components/Icons/InstagramIcon";
    import TwitterIcon from "@/Components/Icons/TwitterIcon";

    export default {
        components: {
            BreezeLayout,
            BreezeButton,
            BreezeInput,
            BreezeCheckbox,
            BreezeTextarea,
            BreezeLabel,
            BreezeValidationErrors,
            BreezeAlert,
            // Icons
            InstagramIcon,
            TwitterIcon,
        },

        props: {
            auth: Object,
            errors: Object,
            status: String,
            pokemon: Array,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: "",
                    email: null,
                    message: "",
                    notRobot: false,
                    sucker: "randomString",
                }),
            };
        },

        mounted() {
            this.$refs.name.focus();
        },

        methods: {
            submit() {
                this.form.post(this.route("contact"), {
                    onFinish: () => this.resetForm(),
                });
            },
            resetForm() {
                this.form.reset();
            },
        },
    };
</script>
