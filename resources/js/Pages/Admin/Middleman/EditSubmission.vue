<template>
    <breeze-layout bg-class="bg-admin">
        <template #header>
            <h2 class="text-4xl text-center text-white">Edit Submission</h2>
        </template>

        <div class="max-w-xl px-4 pb-16 mx-auto sm:px-6 lg:px-8">
            <div
                class="w-full max-w-xl px-4 py-6 mx-auto mt-4 space-y-12 shadow-lg sm:-mt-8 sm:py-12 sm:px-6 lg:px-8 bg-medGray">
                <breeze-validation-errors class="mb-6" />

                <form class="mt-0" @submit.prevent="submit">
                    <div class="space-y-6">
                        <div>
                            <breeze-label for="status" value="Status" />
                            <breeze-select ref="status" id="status" class="block w-full mt-1" v-model="form.status"
                                :no-border="true" required>
                                <option disabled>Select contact type</option>
                                <option v-for="status in statuses" :key="status" :value="status">
                                    {{ $filters.uppercase(status) }}
                                </option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="company" value="Grading Company" />
                            <breeze-select ref="company" id="company" class="block w-full mt-1" v-model="form.company"
                                :no-border="true" required>
                                <option disabled>Select grading company</option>
                                <option v-for="company in filteredCompanyNames" :key="company" :value="company">
                                    {{ company }}
                                </option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="service" value="Grading Service" />
                            <breeze-select ref="service" id="service" class="block w-full mt-1"
                                v-model="form.service_level" :no-border="true" required>
                                <option disabled>Select grading service</option>
                                <option v-for="service in selectedService" :key="service" :value="service">
                                    {{ $filters.allCapitalized(service) }}
                                </option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="number_of_cards" value="Number of Cards" />
                            <breeze-input ref="number_of_cards" id="number_of_cards" type="number" :no-border="true"
                                class="block w-full mt-1" v-model="form.number_of_cards" required />
                        </div>
                        <div>
                            <breeze-label for="grading_fee" value="Grading Fee" />
                            <breeze-input ref="grading_fee" id="grading_fee" type="number" step="0.01" :no-border="true"
                                class="block w-full mt-1" v-model="form.grading_fee" required />
                        </div>
                        <div>
                            <breeze-label for="my_fee" value="Omaash Fee" />
                            <breeze-input ref="my_fee" id="my_fee" type="number" step="0.01" :no-border="true"
                                class="block w-full mt-1" v-model="form.my_fee" />
                        </div>
                        <div>
                            <breeze-label for="shipping_fee" value="Shipping Fee" />
                            <breeze-input ref="shipping_fee" id="shipping_fee" type="number" step="0.01"
                                :no-border="true" class="block w-full mt-1" v-model="form.shipping_fee" />
                        </div>
                        <div>
                            <breeze-label for="card_saver_fee" value="Card Saver Fee" />
                            <breeze-input ref="card_saver_fee" id="card_saver_fee" type="number" step="0.01"
                                :no-border="true" class="block w-full mt-1" v-model="form.card_saver_fee" required />
                        </div>
                        <div>
                            <breeze-label for="auction_off" value="Auction Cards?" />
                            <breeze-select ref="auction_off" id="auction_off" class="block w-full mt-1"
                                v-model="form.auction_off" :no-border="true" required>
                                <option disabled>Auction Cards?</option>
                                <option :value="0">No</option>
                                <option :value="1">Yes</option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="auction_company" value="Auction Company" />
                            <breeze-select ref="auction_company" id="auction_company" class="block w-full mt-1"
                                v-model="form.auction_company" :no-border="true">
                                <option disabled>Auction Company Name</option>
                                <option value="">None</option>
                                <option v-for="companyName in filteredAuctionNames" :key="companyName"
                                    :value="companyName">
                                    {{ companyName }}
                                </option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="paid" value="Paid" />
                            <breeze-select ref="paid" id="paid" class="block w-full mt-1" v-model="form.paid"
                                :no-border="true" required>
                                <option disabled>Submission paid?</option>
                                <option :value="0">No</option>
                                <option :value="1">Yes</option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="completed" value="Completed" />
                            <breeze-select ref="completed" id="completed" class="block w-full mt-1"
                                v-model="form.completed" :no-border="true">
                                <option disabled>Submission complete?</option>
                                <option :value="0">No</option>
                                <option :value="1">Yes</option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="expedited" value="expedited" />
                            <breeze-select ref="expedited" id="expedited" class="block w-full mt-1"
                                v-model="form.expedited" :no-border="true">
                                <option disabled>Submission Expedited?</option>
                                <option :value="0">No</option>
                                <option :value="1">Yes</option>
                            </breeze-select>
                        </div>
                        <div>
                            <breeze-label for="completed_date" value="Completed Date" />
                            <datepicker ref="completed_date" id="completed_date"
                                class="w-full border-0 focus:border-lightBlue focus:ring focus:ring-lightBlue focus:ring-opacity-25"
                                v-model="form.completed_date" />
                        </div>
                        <div>
                            <breeze-label for="send_off_date" value="Send Off Date" />
                            <datepicker ref="send_off_date" id="send_off_date"
                                class="w-full border-0 focus:border-lightBlue focus:ring focus:ring-lightBlue focus:ring-opacity-25"
                                v-model="form.send_off_date" />
                        </div>
                        <div>
                            <breeze-label for="tracking_number" value="Tracking Number" />
                            <breeze-input ref="tracking_number" id="tracking_number" type="text" :no-border="true"
                                class="block w-full mt-1" v-model="form.tracking_number" />
                        </div>
                    </div>

                    <div class="flex grid grid-cols-1 gap-6 mt-12 sm:grid-cols-3 sm:gap-12 sm:space-x-6">
                        <breeze-button @click.prevent="handleBack" color="darkGray" class="sm:col-span-1">
                            Back
                        </breeze-button>
                        <breeze-button class="sm:col-span-2" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Update Submission
                        </breeze-button>
                    </div>
                </form>
            </div>
        </div>
    </breeze-layout>
</template>

<script>
    import Datepicker from "vue3-datepicker";

    import BreezeLayout from "@/Layouts/Layout";
    import Alert from "@/Components/Alert";
    import BreezeButton from "@/Components/Button";
    import BreezeCheckbox from "@/Components/Checkbox";
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
            BreezeCheckbox,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
            BreezeTextarea,
            BreezeSelect,
            Datepicker,
        },
        props: {
            submission: Object,
            companies: Object,
            auctionCompanies: Object,
            statuses: Array,
            errors: Object,
            status: String,
        },
        data() {
            return {
                picked: new Date(),
                form: this.$inertia.form({
                    status: "",
                    company: "",
                    service_level: "",
                    number_of_cards: null,
                    grading_fee: "",
                    my_fee: "",
                    shipping_fee: "",
                    card_saver_fee: "",
                    paid: null,
                    completed: null,
                    expedited: null,
                    auction_off: null,
                    auction_company: "",
                    sold_for: null,
                    payout: null,
                    completed_date: null,
                    send_off_date: null,
                    tracking_number: null,
                }),
            };
        },
        computed: {
            filteredCompanyNames() {
                return Object.keys(this.companies);
            },
            filteredAuctionNames() {
                return Object.keys(this.auctionCompanies);
            }, 
            selectedService() {
                let selectedService;
                if (this.form.company === "") {
                    selectedService = [];
                } else {
                    selectedService = this.companies[this.form.company];
                }
                return selectedService;
            },
        },
        mounted() {
            this.handleEditSubmission();
        },
        methods: {
            handleEditSubmission() {
                let submissionObj = this.submission;
                this.form.company = submissionObj.company;
                this.form.service_level = submissionObj.service_level;
                this.form.status = submissionObj.status;
                this.form.number_of_cards = submissionObj.number_of_cards;
                this.form.grading_fee = submissionObj.grading_fee;
                this.form.my_fee = submissionObj.my_fee;
                this.form.shipping_fee = submissionObj.shipping_fee;
                this.form.card_saver_fee = submissionObj.card_saver_fee;
                this.form.auction_off = submissionObj.auction_off;
                this.form.auction_company = submissionObj.auction_company;
                this.form.paid = submissionObj.paid;
                this.form.expedited = submissionObj.expedited;
                this.form.completed = submissionObj.completed;
                this.form.completed_date = submissionObj.completed_date
                    ? new Date(submissionObj.completed_date)
                    : null;
                this.form.send_off_date = submissionObj.send_off_date
                    ? new Date(submissionObj.send_off_date)
                    : null;
                this.form.tracking_number = submissionObj.tracking_number;
            },
            submit() {
                this.form
                    .transform((data) => ({
                        ...data,
                        service_level: data.service_level,
                        completed_date: data.completed_date
                            ? new Date(
                                  data.completed_date -
                                      data.completed_date.getTimezoneOffset() *
                                          60 *
                                          1000
                              )
                                  .toISOString()
                                  .split("T")[0]
                            : null,
                        send_off_date: data.send_off_date
                            ? new Date(
                                  data.send_off_date -
                                      data.send_off_date.getTimezoneOffset() *
                                          60 *
                                          1000
                              )
                                  .toISOString()
                                  .split("T")[0]
                            : null,
                    }))
                    .post(`/admin/middleman/submission/${this.submission.id}`, {
                        onFinish: () => this.resetForm(),
                    });
            },
            resetForm() {
                this.form.reset();
            },
            handleBack() {
                this.$inertia.visit("/admin/middleman/submissions");
            },
        },
    };
</script>
