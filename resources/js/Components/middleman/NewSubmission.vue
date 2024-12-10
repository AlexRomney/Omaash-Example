<template>
    <div>
        <div class="py-12 sm:py-24">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="relative border-4 bg-medGray sm:space-y-0 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 border-darkBlue">
                    <div class="w-full px-6 py-8 lg:p-12">
                        <div class="">
                            <div class="flex items-center">
                                <h4 class="flex flex-col items-start flex-shrink-0 pr-4 sm:items-center sm:flex-row">
                                    <span class="text-2xl sm:text-3xl text-lightBlue">
                                        New Submission
                                    </span>
                                    <helper-modal class="mt-2 sm:mt-0 sm:ml-4" btn-text="Shipping Cost"
                                        bg-class="bg-white">
                                        <h4 class="text-2xl">Shipping Cost</h4>
                                        <p class="mt-4">
                                            Shipping costs vary by submission
                                            making it difficult to estimate up
                                            front. It is common to see shipping
                                            costs between $25-$50, but they
                                            could be more. This total is not
                                            calculated until after your cards
                                            are submitted by me. Once that step
                                            is complete, I will send you your
                                            updated total to complete payment.
                                        </p>
                                    </helper-modal>
                                </h4>
                                <div class="flex-1 hidden border-t-2 sm:flex border-darkGray"></div>
                            </div>

                            <breeze-validation-errors class="mt-6" />

                            <breeze-alert v-show="status" title="Status" :description="status" type="success"
                                class="mt-6" />

                            <div class="grid grid-cols-1 gap-6 mt-8 sm:gap-12 lg:mt-12 lg:grid-cols-2">
                                <form @submit.prevent="submit">
                                    <div class="space-y-6">
                                        <div>
                                            <breeze-label for="company" value="Grading Company" />
                                            <breeze-select ref="company" id="company" class="block w-full mt-1"
                                                v-model="form.company" :no-border="true" required>
                                                <option disabled>
                                                    Select grading company
                                                </option>
                                                <option v-for="company in filteredCompanyNames" :key="company"
                                                    :value="company">
                                                    {{ company }}
                                                </option>
                                            </breeze-select>
                                        </div>

                                        <div>
                                            <breeze-label for="service" value="Grading Service" />
                                            <breeze-select ref="service" id="service" class="block w-full mt-1"
                                                v-model="form.serviceLevel" :no-border="true" required>
                                                <option disabled>
                                                    Select grading service
                                                </option>
                                                <option v-for="service in selectedService" :key="service"
                                                    :value="service">
                                                    {{
                                                        $filters.allCapitalized(service)
                                                    }}
                                                </option>
                                            </breeze-select>
                                        </div>
                                        <div>
                                            <breeze-label for="cards" value="Number of Cards" />
                                            <breeze-input ref="cards" id="cards" type="number" :no-border="true"
                                                class="block w-full mt-1" v-model="form.numberOfCards" required />
                                        </div>
                                        <div class="relative flex items-center">
                                            <div class="flex items-center h-5">
                                                <breeze-checkbox id="auctionOff"
                                                    aria-describedby="auction-off-description" name="auctionOff"
                                                    v-model="form.auctionOff" />
                                            </div>
                                            <div class="ml-3 leading-snug">
                                                <label for="auctionOff"
                                                    class="cursor-pointer select-none text-darkGray">
                                                    Do you want to auction your cards?
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="form.auctionOff">
                                            <breeze-label for="auctionCompany" value="Auction Company" />
                                            <breeze-select ref="auctionCompany" id="auctionCompany"
                                                class="block w-full mt-1" v-model="form.auctionCompany"
                                                :no-border="true">
                                                <option disabled>
                                                    Select auction company
                                                </option>
                                                <option v-for="companyName in filteredAuctionNames" :key="companyName"
                                                    :value="companyName">
                                                    {{
                                                        $filters.allCapitalized(companyName)
                                                    }}
                                                </option>
                                            </breeze-select>
                                        </div>
                                        <div>
                                            <breeze-label for="note" class="flex items-center justify-between w-full">
                                                <span> Note (Optional) </span>
                                                <helper-modal size="small" :hide-icon="true"
                                                    btn-text="What should I add?" bg-class="bg-white">
                                                    <h4 class="text-2xl">
                                                        What should I add?
                                                    </h4>
                                                    <p class="mt-4 text-base">
                                                        If you have any cards
                                                        that are in another
                                                        language, error
                                                        cards or just not well
                                                        known please make sure
                                                        to list them in the
                                                        notes. Any extra
                                                        information you feel is
                                                        necessary and want
                                                        Omaash to see is welcome
                                                        here as well.
                                                    </p>
                                                </helper-modal>
                                            </breeze-label>
                                            <breeze-textarea ref="note" id="note" type="text" rows="2" :no-border="true"
                                                class="block w-full mt-1 placeholder-gray-400" v-model="form.note"
                                                placeholder="Please add any extra info about the submission here." />
                                        </div>
                                        <div class="flex flex-col items-start sm:items-center sm:flex-row">
                                            <div class="relative flex items-center">
                                                <div class="flex items-center h-5">
                                                    <breeze-checkbox id="expedited"
                                                        aria-describedby="expedited-description" name="expedited"
                                                        v-model="
                                                            form.expedited
                                                        " />
                                                </div>
                                                <div class="ml-3 leading-snug">
                                                    <label for="expedited"
                                                        class="cursor-pointer select-none text-darkGray">Expedite
                                                        Submission?</label>
                                                </div>
                                            </div>
                                            <helper-modal class="mt-2 sm:mt-0 sm:ml-4" size="small" :hide-icon="true"
                                                btn-text="More Info" bg-class="bg-white">
                                                <h4 class="text-2xl">
                                                    More Info
                                                </h4>
                                                <p class="mt-4">
                                                    Don’t want to wait for the bi-monthly submission date? With this
                                                    option,
                                                    Omaash will send your cards the day after he receives them, getting
                                                    them
                                                    out the door as soon as possible. Adds an additional $25 to the
                                                    submission total.
                                                </p>
                                            </helper-modal>
                                        </div>
                                        <div class="flex flex-col items-start sm:items-center sm:flex-row">
                                            <div class="relative flex items-center">
                                                <div class="flex items-center h-5">
                                                    <breeze-checkbox id="card-saver"
                                                        aria-describedby="card-saver-description" name="card-saver"
                                                        v-model="
                                                            form.needsCardSavers
                                                        " />
                                                </div>
                                                <div class="ml-3 leading-snug">
                                                    <label for="card-saver"
                                                        class="cursor-pointer select-none text-darkGray">Do you need
                                                        card
                                                        savers?</label>
                                                </div>
                                            </div>
                                            <helper-modal class="mt-2 sm:mt-0 sm:ml-4" size="small" :hide-icon="true"
                                                btn-text="Card Saver Prices" bg-class="bg-white">
                                                <h4 class="text-2xl">
                                                    Card Saver Prices
                                                </h4>
                                                <p class="mt-4">
                                                    If you need Card Savers they
                                                    are $0.25 each for 10 cards
                                                    and under. Anything more
                                                    than 10 cards is $0.50 each.
                                                </p>
                                            </helper-modal>
                                        </div>
                                        <div class="flex flex-col items-start sm:items-center sm:flex-row">
                                            <div class="relative flex items-center">
                                                <div class="flex items-center h-5">
                                                    <breeze-checkbox id="accepted-terms"
                                                        aria-describedby="accepted-terms-description"
                                                        name="accepted-terms" v-model="
                                                            form.acceptedTerms
                                                        " required />
                                                </div>
                                                <div class="ml-3 leading-snug">
                                                    <label for="accepted-terms"
                                                        class="cursor-pointer select-none text-darkGray">Do you accept
                                                        to the
                                                        terms &
                                                        conditions?</label>
                                                </div>
                                            </div>
                                            <helper-modal class="mt-2 sm:mt-0 sm:ml-4" size="small" :hide-icon="true"
                                                btn-text="View Terms & Conditions" bg-class="bg-white">
                                                <h6 class="text-lg">
                                                    Omaash Middleman Service
                                                    Terms & Conditions
                                                </h6>
                                                <p class="mt-4 text-sm">
                                                    By submitting my cards to
                                                    Omaash, I assume
                                                    responsibility for any risk
                                                    that may occur throughout
                                                    the shipping and grading
                                                    process.
                                                </p>
                                                <p class="mt-4 text-sm">
                                                    I understand that my cards
                                                    will be handled by Omaash,
                                                    the grading company and the auction
                                                    company and that while they will do all
                                                    they can to prevent damage
                                                    to the cards, there is still
                                                    a possibility that damage
                                                    may occur.
                                                </p>
                                                <p class="mt-4 text-sm">
                                                    I am responsible for
                                                    packaging and shipping my
                                                    cards to Omaash using his
                                                    recommended measures to
                                                    prevent my cards being lost
                                                    or damaged in transit.
                                                </p>
                                                <div class="mt-4 text-sm">
                                                    <p>
                                                        Omaash is not liable
                                                        for:
                                                    </p>
                                                    <ul role="list" class="space-y-1 text-sm list-disc list-inside">
                                                        <li>
                                                            Any damage that
                                                            might occur to your
                                                            cards throughout
                                                            the standard grading
                                                            and shipping process
                                                        </li>
                                                        <li>
                                                            Cards receiving
                                                            different grades
                                                            than expected
                                                        </li>
                                                        <li>
                                                            Lost or stolen cards
                                                            in the mail
                                                        </li>
                                                        <li>
                                                            Incurred shipping or
                                                            insurance costs
                                                        </li>
                                                        <li>
                                                            How long it takes
                                                            companies to grade
                                                            and return the cards
                                                        </li>
                                                        <li>
                                                            What a card sells for
                                                            at auction
                                                        </li>
                                                        <li>
                                                            How long it takes for <span class="underline">ALL</span>
                                                            of your cards to sell and get your payout.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </helper-modal>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 mt-12 sm:gap-6 sm:grid-cols-4 lg:grid-cols-5">
                                        <breeze-button @click.prevent="
                                                showConfirmModal = true
                                            " width="full" size="small" :disabled="form.processing"
                                            class="sm:col-span-2 lg:col-span-3" color="lightBlue">
                                            Submit
                                        </breeze-button>
                                        <breeze-button @click.prevent="handleCostEstimate" width="full" size="small"
                                            class="sm:col-span-2 lg:col-span-2" color="darkGray">
                                            Calculate
                                        </breeze-button>
                                    </div>
                                    <p v-if="estimateError" class="block mt-2 text-sm text-red-600" key="error">
                                        Looks like something went wrong with
                                        estimating your grading cost. Please try
                                        again.
                                    </p>
                                </form>

                                <div class="mt-6 sm:mt-0">
                                    <transition mode="out-in" enter-active-class="transition duration-300 ease-out"
                                        leave-active-class="transition duration-200 ease-in" enter-class="opacity-0"
                                        leave-class="opacity-100" enter-to-class="opacity-100"
                                        leave-to-class="opacity-0">
                                        <div v-if="!hasFees" key="loading" class="py-12 mx-auto text-center">
                                            <pokeball-loader :loading="hasFeesLoading" />
                                        </div>
                                        <div v-else key="results">
                                            <h4 class="text-2xl text-lightBlue">
                                                Estimate
                                            </h4>
                                            <div class="mt-4 space-y-2 text-center font-bungee">
                                                <div class="flex items-center justify-between">
                                                    <span>Grading Fee:</span>
                                                    <span>${{
                                                        $filters.number(
                                                        fees.gradingFee
                                                        )
                                                        }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span>My Fee:</span>
                                                    <span>${{
                                                        $filters.number(
                                                        fees.myFee
                                                        )
                                                        }}</span>
                                                </div>
                                                <div v-if="fees.cardSaverFee"
                                                    class="flex items-center justify-between pb-4">
                                                    <span>Card Saver Fee:</span>
                                                    <span>${{
                                                        $filters.number(
                                                        fees.cardSaverFee
                                                        )
                                                        }}</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between pt-4 text-lg border-t font-bungee border-darkBlue">
                                                    <span>Total:</span>
                                                    <span>${{
                                                        $filters.number(
                                                        fees.total
                                                        )
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>

                                    <!-- Logo -->
                                    <div class="hidden md:block">
                                        <img src="/images/omaash-avatar-full.png"
                                            class="absolute bottom-0 hidden w-auto lg:block lg:h-64 xl:h-72 lg:right-24 xl:right-40" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <breeze-modal :open="showConfirmModal" @close="showConfirmModal = false">
            <h3 class="text-3xl">Are you sure?</h3>
            <p v-if="form.company && form.numberOfCards && form.serviceLevel" class="mt-2 text-left">
                Are you ready to create this
                {{ $filters.uppercase(form.serviceLevel) }} submission to
                {{ $filters.allCaps(form.company) }} with
                {{ form.numberOfCards }} Cards?
            </p>
            <p v-else class="mt-2 text-left">
                Are you ready to create this submission? Please make sure all
                the required form fields have been filled out.
            </p>
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2">
                <breeze-button @click.prevent="showConfirmModal = false" width="full" size="small" class=""
                    color="darkGray">
                    Cancel
                </breeze-button>
                <breeze-button @click.prevent="submit" width="full" size="small" :disabled="form.processing" class=""
                    color="lightBlue">
                    Yes, Submit
                </breeze-button>
            </div>
        </breeze-modal>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeSelect from "@/Components/Select";
    import BreezeTextarea from "@/Components/Textarea";
    import BreezeCheckbox from "@/Components/Checkbox";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeAlert from "@/Components/Alert";
    import HelperModal from "@/Components/HelperModal";
    import BreezeModal from "@/Components/Modal";
    import PokeballLoader from "@/Components/PokeballLoader";

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeSelect,
            BreezeTextarea,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors,
            PokeballLoader,
            BreezeAlert,
            HelperModal,
            BreezeModal,
        },

        props: {
            auth: Object,
            companies: Object,
            errors: Object,
            auctionCompanies: Object,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    company: "",
                    serviceLevel: "",
                    numberOfCards: null,
                    note: "",
                    needsCardSavers: false,
                    expedited: false,
                    auctionOff: false,
                    auctionCompany: "",
                    acceptedTerms: false,
                }),
                showConfirmModal: false,
                hasFeesLoading: false,
                hasFees: false,
                fees: {
                    gradingFee: 0,
                    myFee: 0,
                    cardSaverFee: 0,
                    total: 0,
                },
                estimateError: false
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
            this.$refs.company.focus();
            this.showConfirmModal = false;
        },

        methods: {
            submit() {
                this.showConfirmModal = false;
                this.form
                    .transform((data) => ({
                        ...data,
                        serviceLevel: data.serviceLevel
                    }))
                    .post(this.route("middleman/submission-submit"), {
                        onFinish: () => console.log("On Finish New Submission"),
                    });
            },
            /**
             * Cost Estimator
             */
            handleCostEstimate() {
                this.hasFees = false;
                this.hasFeesLoading = true;
                this.estimateError = false;
                const payload = { ...this.form };
                setTimeout(() => {
                    axios
                        .post("/middleman/estimator", payload)
                        .then((response) => {
                            if (response.data.fees) {
                                this.fees = response.data.fees;
                                this.hasFees = true;
                            } else {
                                this.hasFees = false;
                                this.estimateError = true;
                            }
                            this.hasFeesLoading = false;
                        })
                        .catch((err) => {
                            this.resetFormFields();
                            this.hasFees = false;
                            this.hasFeesLoading = false;
                            this.estimateError = true;
                        });
                }, 1500);
            },
            resetFormFields() {
                this.form.company = "";
                this.form.serviceLevel = "";
                this.form.numberOfCards = null;
                this.form.needsCardSavers = false;
                this.form.expedited = false;
                this.form.auctionOff = false;
                this.form.auctionCompany = "";
            },
            resetCostFields() {
                this.fees = {
                    gradingFee: 0,
                    myFee: 0,
                    cardSaverFee: 0,
                    total: 0,
                };
            },
            handleCostEstimateReset() {
                this.hasFees = false;
                this.hasFeesLoading = false;
                this.estimateError = false;
                this.resetFormFields();
                this.resetCostFields();
            },
        },
    };
</script>
