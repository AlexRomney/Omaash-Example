<template>
    <breeze-layout bg-class="bg-profile">
        <template #header>
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-4xl text-center text-white">Profile</h2>
                <alert
                    class="mt-4"
                    :show="middleware"
                    type="warning"
                    title="Complete Your Profile"
                    description="You must complete your profile in order to continue."
                />
            </div>
        </template>

        <!-- Edit Form -->
        <div class="max-w-xl px-4 pb-16 mx-auto sm:px-6 lg:px-8">
            <div
                class="w-full max-w-xl px-4 py-6 mx-auto mt-4 space-y-12 shadow-lg sm:-mt-8 sm:py-12 sm:px-6 lg:px-8 bg-medGray"
            >
                <div class="mx-auto mb-6 text-center">
                    <h4 class="text-2xl sm:text-3xl text-lightBlue">
                        {{ middleware ? "Complete" : "Edit" }} Profile
                    </h4>
                    <p class="max-w-md mx-auto mt-2">
                        Update your profile to make sure your info is up to
                        date. Any submissions will use your profile information.
                    </p>
                </div>

                <div>
                    <breeze-validation-errors class="mb-6" />

                    <alert
                        v-show="status"
                        title="Status"
                        :description="status"
                        type="success"
                        class="mb-6"
                    />

                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <breeze-label for="username" value="Username" />
                                <breeze-input
                                    ref="username"
                                    id="username"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.username"
                                    required
                                />
                            </div>

                            <div>
                                <breeze-label
                                    for="first_name"
                                    value="First Name"
                                />
                                <breeze-input
                                    ref="first_name"
                                    id="first_name"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.first_name"
                                    required
                                />
                            </div>
                            <div>
                                <breeze-label
                                    for="last_name"
                                    value="Last Name"
                                />
                                <breeze-input
                                    ref="last_name"
                                    id="last_name"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.last_name"
                                    required
                                />
                            </div>
                            <div>
                                <breeze-label
                                    for="contact_type"
                                    value="Contact Type"
                                />
                                <breeze-select
                                    ref="contact_type"
                                    id="contact_type"
                                    class="block w-full mt-1"
                                    v-model="form.contact_type"
                                    :no-border="true"
                                    required
                                >
                                    <option disabled>
                                        Select contact type
                                    </option>
                                    <option
                                        v-for="contact in contactTypes"
                                        :key="contact.text"
                                        :value="contact.value"
                                    >
                                        {{ contact.text }}
                                    </option>
                                </breeze-select>
                            </div>
                            <div>
                                <breeze-label
                                    for="contact_handle"
                                    value="Contact Handle"
                                />
                                <breeze-input
                                    v-if="form.contact_type === 'email'"
                                    ref="contact_handle"
                                    id="contact_handle"
                                    type="email"
                                    :no-border="true"
                                    placeholder="Ex: omaashopenings@gmail.com"
                                    class="block w-full mt-1"
                                    v-model="form.contact_handle"
                                    required
                                />
                                <breeze-input
                                    v-else
                                    ref="contact_handle"
                                    id="contact_handle"
                                    type="text"
                                    :no-border="true"
                                    placeholder="Ex: @omaash "
                                    class="block w-full mt-1"
                                    v-model="form.contact_handle"
                                    required
                                />
                            </div>
                            <div>
                                <breeze-label
                                    for="payment_type"
                                    value="Payment Type"
                                />
                                <breeze-select
                                    ref="payment_type"
                                    id="payment_type"
                                    class="block w-full mt-1"
                                    v-model="form.payment_type"
                                    :no-border="true"
                                    required
                                >
                                    <option disabled>
                                        Select payment type
                                    </option>
                                    <option
                                        v-for="payment in paymentTypes"
                                        :key="payment.text"
                                        :value="payment.value"
                                    >
                                        {{ payment.text }}
                                    </option>
                                </breeze-select>
                            </div>

                            <div>
                                <breeze-label
                                    for="shipping_type"
                                    value="Shipping Type"
                                />
                                <breeze-select
                                    ref="shipping_type"
                                    id="shipping_type"
                                    class="block w-full mt-1"
                                    v-model="form.shipping_type"
                                    :no-border="true"
                                    required
                                >
                                    <option disabled>
                                        Select shipping type
                                    </option>
                                    <option
                                        v-for="shipping in shippingTypes"
                                        :key="shipping.text"
                                        :value="shipping.value"
                                    >
                                        {{ shipping.text }}
                                    </option>
                                </breeze-select>
                            </div>

                            <!-- International -->
                            <div v-if="form.shipping_type === 'international'">
                                <breeze-label
                                    for="international_address"
                                    value="International Address"
                                />
                                <breeze-textarea
                                    ref="international_address"
                                    id="international_address"
                                    type="text"
                                    :no-border="true"
                                    class="block w-full mt-1"
                                    v-model="form.international_address"
                                    required
                                />
                                <p class="mt-1 text-sm text-darkGray">
                                    * Put your address, city, state, postal code
                                    and country
                                </p>
                            </div>
                            <!-- States -->
                            <div
                                v-if="form.shipping_type === 'states'"
                                class="space-y-6"
                            >
                                <div>
                                    <breeze-label
                                        for="address"
                                        value="Address"
                                    />
                                    <breeze-input
                                        ref="address"
                                        id="address"
                                        type="text"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.address"
                                        required
                                    />
                                </div>
                                <div>
                                    <breeze-label for="city" value="City" />
                                    <breeze-input
                                        ref="city"
                                        id="city"
                                        type="text"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.city"
                                        required
                                    />
                                </div>
                                <div>
                                    <breeze-label for="state" value="State" />
                                    <breeze-input
                                        ref="state"
                                        id="state"
                                        type="text"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.state"
                                        required
                                    />
                                </div>
                                <div>
                                    <breeze-label for="zip" value="Zip Code" />
                                    <breeze-input
                                        ref="zip"
                                        id="zip"
                                        type="text"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.zip"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex grid grid-cols-1 gap-6 mt-12 sm:grid-cols-2 sm:gap-6"
                        >
                            <div>
                                <breeze-button
                                    v-show="!middleware"
                                    @click.prevent="handleBack"
                                    color="darkGray"
                                    class="w-full sm:w-auto"
                                >
                                    Back to Profile
                                </breeze-button>
                            </div>
                            <breeze-button
                                class="w-full ml-auto"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Update Profile
                            </breeze-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Edit Form -->
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import Alert from "@/Components/Alert";
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeTextarea from "@/Components/Textarea";
    import BreezeSelect from "@/Components/Select";

    export default {
        components: {
            BreezeLayout,
            Alert,
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
            BreezeTextarea,
            BreezeSelect,
        },
        props: {
            auth: Object,
            errors: Object,
            status: String,
            middleware: Boolean,
        },
        data() {
            return {
                form: this.$inertia.form({
                    username: "",
                    first_name: "",
                    last_name: "",
                    shipping_type: "",
                    contact_type: "",
                    contact_handle: "",
                    payment_type: "",
                    // Optional
                    international_address: "",
                    address: "",
                    city: "",
                    state: "",
                    zip: "",
                }),
                contactTypes: [
                    {
                        value: "facebook",
                        text: "Facebook",
                    },
                    {
                        value: "twitter",
                        text: "Twitter",
                    },
                    {
                        value: "instagram",
                        text: "Instagram",
                    },
                    {
                        value: "email",
                        text: "Email",
                    },
                ],
                paymentTypes: [
                    {
                        value: "paypal",
                        text: "PayPal",
                    },
                    {
                        value: "venmo",
                        text: "Venmo",
                    },
                    {
                        value: "cash app",
                        text: "Cash App",
                    },
                ],
                shippingTypes: [
                    {
                        value: "states",
                        text: "States",
                    },
                    {
                        value: "international",
                        text: "International",
                    },
                ],
            };
        },
        mounted() {
            this.handleEditProfile();
        },
        methods: {
            handleEditProfile() {
                let userObj = this.auth.user;
                this.form.username = userObj.username;
                this.form.first_name = userObj.first_name;
                this.form.last_name = userObj.last_name;
                this.form.shipping_type = userObj.shipping_type;
                this.form.contact_type = userObj.contact_type;
                this.form.contact_handle = userObj.contact_handle;
                this.form.payment_type = userObj.payment_type;
                // Optional
                this.form.international_address = userObj.international_address;
                this.form.address = userObj.address;
                this.form.city = userObj.city;
                this.form.state = userObj.state;
                this.form.zip = userObj.zip;
            },
            submit() {
                this.form.post(this.route("user/update-profile"), {
                    onFinish: () => this.resetForm(),
                });
            },
            resetForm() {
                this.form.reset();
            },
            handleBack() {
                this.$inertia.visit("/user/profile");
            },
        },
    };
</script>
