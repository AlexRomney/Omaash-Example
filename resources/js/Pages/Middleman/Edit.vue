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
                            <breeze-label for="needs_card_savers" value="Need Card Savers" />
                            <breeze-select ref="needs_card_savers" id="needs_card_savers" class="block w-full mt-1"
                                v-model="form.needs_card_savers" :no-border="true">
                                <option disabled>Need card savers?</option>
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
                            <breeze-label for="auctionOff" value="Auction Cards" />
                            <breeze-select ref="auctionOff" id="auctionOff" class="block w-full mt-1"
                                v-model="form.auctionOff" :no-border="true">
                                <option disabled>Auction Cards?</option>
                                <option :value="0">No</option>
                                <option :value="1">Yes</option>
                            </breeze-select>
                        </div>
                        <div v-if="form.auctionOff && form.auctionOff !== '0'">
                            <breeze-label for="auctionCompany" value="Auction Company" />
                            <breeze-select ref="auctionCompany" id="auctionCompany" class="block w-full mt-1"
                                v-model="form.auctionCompany" :no-border="true">
                                <option disabled>Auction Company Name</option>
                                <option v-for="companyName in filteredAuctionNames" :key="companyName"
                                    :value="companyName">
                                    {{ companyName }}
                                </option>
                            </breeze-select>
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
    import BreezeLayout from "@/Layouts/Layout";
    import Alert from "@/Components/Alert";
    import BreezeButton from "@/Components/Button";
    import BreezeCheckbox from "@/Components/Checkbox";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
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
            BreezeSelect,
        },
        props: {
            submission: Object,
            companies: Object,
            auctionCompanies: Object,
            errors: Object,
            status: String,
        },
        data() {
            return {
                picked: new Date(),
                form: this.$inertia.form({
                    company: "",
                    service_level: "",
                    number_of_cards: null,
                    needs_card_savers: null,
                    expedited: null,
                    auctionOff: false,
                    auctionCompany: ""
                })
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
                this.form.number_of_cards = submissionObj.number_of_cards;
                this.form.expedited = submissionObj.expedited;
                this.form.needs_card_savers = submissionObj.needs_card_savers;
                this.form.auctionOff = submissionObj.auction_off;
                this.form.auctionCompany = submissionObj.auction_company;
            },
            submit() {
                this.form
                    .transform((data) => ({
                        ...data,
                        service_level: data.service_level
                    }))
                    .post(`/middleman/submission/edit/${this.submission.id}`, {
                        onFinish: () => this.resetForm(),
                    });
            },
            resetForm() {
                this.form.reset();
            },
            handleBack() {
                this.$inertia.visit("/middleman/submissions");
            },
        },
    };
</script>
