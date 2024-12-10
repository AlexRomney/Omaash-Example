<template>
    <div class="py-12 sm:py-24">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="relative border-4 bg-medGray sm:space-y-0 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 border-darkBlue"
            >
                <div class="w-full px-6 py-8 lg:p-12">
                    <div class="">
                        <div class="flex items-center">
                            <h4
                                class="flex flex-col items-start flex-shrink-0 pr-4 sm:items-center sm:flex-row"
                            >
                                <span
                                    class="text-2xl sm:text-3xl text-lightBlue"
                                >
                                    Cost Estimator
                                </span>
                                <helper-modal
                                    class="mt-2 sm:mt-0 sm:ml-4"
                                    btn-text="Shipping Cost"
                                    bg-class="bg-white"
                                >
                                    <h4 class="text-2xl">Shipping Cost</h4>
                                    <p class="mt-4">
                                        Shipping costs vary by submission making
                                        it difficult to estimate up front. It is
                                        common to see shipping costs between
                                        $25-$50, but they could be more. This
                                        total is not calculated until after your
                                        cards are submitted by me. Once that
                                        step is complete, I will send you your
                                        updated total to complete payment.
                                    </p>
                                </helper-modal>
                            </h4>
                            <div
                                class="flex-1 hidden border-t-2 md:flex border-darkGray"
                            ></div>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-6 mt-8 sm:gap-12 lg:mt-12 md:grid-cols-2"
                        >
                            <form
                                @submit.prevent="handleCostEstimate"
                                class="space-y-6"
                            >
                                <div>
                                    <breeze-label
                                        for="company"
                                        value="Grading Company"
                                    />
                                    <breeze-select
                                        ref="company"
                                        id="company"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.company"
                                        required
                                    >
                                        <option disabled selected>
                                            Select grading company
                                        </option>
                                        <option
                                            v-for="company in filteredCompanyNames"
                                            :key="company"
                                            :value="company"
                                        >
                                            {{ company }}
                                        </option>
                                    </breeze-select>
                                </div>
                                <div>
                                    <breeze-label
                                        for="service"
                                        value="Grading Service"
                                    />
                                    <breeze-select
                                        ref="service"
                                        id="service"
                                        :no-border="true"
                                        class="block w-full mt-1"
                                        v-model="form.serviceLevel"
                                        required
                                    >
                                        <option disabled>
                                            Select grading service
                                        </option>
                                        <option
                                            v-for="service in selectedService"
                                            :key="service"
                                            :value="service"
                                        >
                                            {{
                                                $filters.allCapitalized(service)
                                            }}
                                        </option>
                                    </breeze-select>
                                </div>
                                <div>
                                    <breeze-label
                                        for="cards"
                                        value="Number of Cards"
                                    />
                                    <breeze-input
                                        ref="cards"
                                        id="cards"
                                        :no-border="true"
                                        type="number"
                                        class="block w-full mt-1"
                                        v-model="form.numberOfCards"
                                        required
                                    />
                                </div>
                                <div
                                    class="flex flex-col items-start sm:items-center sm:flex-row"
                                >
                                    <div
                                        class="relative flex items-center"
                                    >
                                        <div
                                            class="flex items-center h-5"
                                        >
                                            <breeze-checkbox
                                                id="expedited"
                                                aria-describedby="expedited-description"
                                                name="expedited"
                                                v-model="
                                                    form.expedited
                                                "
                                            />
                                        </div>
                                        <div class="ml-3 leading-snug">
                                            <label
                                                for="expedited"
                                                class="cursor-pointer select-none text-darkGray"
                                                >Expedite Submission?</label
                                            >
                                        </div>
                                    </div>
                                    <helper-modal
                                        class="mt-2 sm:mt-0 sm:ml-4"
                                        size="small"
                                        :hide-icon="true"
                                        btn-text="More Info"
                                        bg-class="bg-white"
                                    >
                                        <h4 class="text-2xl">
                                            More Info
                                        </h4>
                                        <p class="mt-4">
                                            Don’t want to wait for the bi-monthly submission date? With this option, 
                                            Omaash will send your cards the day after he receives them, getting them 
                                            out the door as soon as possible. Adds an additional $25 to the submission total. 
                                        </p>
                                    </helper-modal>
                                </div>
                                <div>
                                    <div class="relative flex items-center">
                                        <div class="flex items-center h-5">
                                            <breeze-checkbox
                                                id="card-saver"
                                                aria-describedby="card-saver-description"
                                                name="card-saver"
                                                v-model="form.needsCardSavers"
                                            />
                                        </div>
                                        <div class="ml-3 cursor-pointer">
                                            <label
                                                for="card-saver"
                                                class="select-none text-darkGray"
                                                >Do you need card savers?</label
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <div
                                        class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-4 lg:grid-cols-5"
                                    >
                                        <breeze-button
                                            @click.prevent="handleCostEstimate"
                                            width="full"
                                            size="small"
                                            class="sm:col-span-3 md:col-span-2 lg:col-span-3"
                                            color="lightBlue"
                                        >
                                            Calculate
                                        </breeze-button>
                                        <breeze-button
                                            @click.prevent="
                                                handleCostEstimateReset
                                            "
                                            width="full"
                                            size="small"
                                            class="sm:col-span-1 md:col-span-2 lg:col-span-2"
                                            color="darkGray"
                                        >
                                            Reset
                                        </breeze-button>
                                    </div>
                                    <p
                                        v-if="estimateError"
                                        class="block mt-2 text-sm text-red-600"
                                        key="error"
                                    >
                                        Looks like something went wrong with
                                        estimating your grading cost. Please try
                                        again.
                                    </p>
                                </div>
                            </form>

                            <div class="mt-6 sm:mt-0">
                                <transition
                                    mode="out-in"
                                    enter-active-class="transition duration-300 ease-out"
                                    leave-active-class="transition duration-200 ease-in"
                                    enter-class="opacity-0"
                                    leave-class="opacity-100"
                                    enter-to-class="opacity-100"
                                    leave-to-class="opacity-0"
                                >
                                    <div
                                        v-if="!hasFees"
                                        key="loading"
                                        class="mx-auto text-center"
                                        :class="{ 'py-12': hasFeesLoading }"
                                    >
                                        <pokeball-loader
                                            :loading="hasFeesLoading"
                                        />
                                    </div>
                                    <div v-else key="results">
                                        <h4 class="text-2xl text-lightBlue">
                                            Estimate
                                        </h4>
                                        <div
                                            class="mt-4 space-y-2 text-center font-bungee"
                                        >
                                            <div
                                                class="flex items-center justify-between"
                                            >
                                                <span>Grading Fee:</span>
                                                <span
                                                    >${{
                                                        $filters.number(
                                                            fees.gradingFee
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                            <div
                                                class="flex items-center justify-between"
                                            >
                                                <span>My Fee:</span>
                                                <span
                                                    >${{
                                                        $filters.number(
                                                            fees.myFee
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                            <div
                                                v-if="fees.cardSaverFee"
                                                class="flex items-center justify-between pb-4"
                                            >
                                                <span>Card Saver Fee:</span>
                                                <span
                                                    >${{
                                                        $filters.number(
                                                            fees.cardSaverFee
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                            <div
                                                class="flex items-center justify-between pt-4 text-lg border-t font-bungee border-darkBlue"
                                            >
                                                <span>Total:</span>
                                                <span
                                                    >${{
                                                        $filters.number(
                                                            fees.total
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </transition>

                                <!-- Logo -->
                                <div class="hidden md:block">
                                    <img
                                        src="/images/omaash-avatar-full.png"
                                        class="absolute bottom-0 hidden w-auto md:block md:h-48 lg:h-48 xl:h-56 md:right-24 lg:right-32 xl:right-40"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeCheckbox from "@/Components/Checkbox";
    import BreezeTextarea from "@/Components/Textarea";
    import BreezeSelect from "@/Components/Select";
    import BreezeLabel from "@/Components/Label";
    import PokeballLoader from "@/Components/PokeballLoader";
    import HelperModal from "@/Components/HelperModal";

    import axios from "axios";

    export default {
        props: {
            companies: {
                type: Object,
                required: true,
            },
        },
        components: {
            BreezeButton,
            BreezeInput,
            BreezeSelect,
            BreezeCheckbox,
            BreezeTextarea,
            BreezeLabel,
            PokeballLoader,
            HelperModal,
        },
        data() {
            return {
                form: {
                    company: "PSA",
                    serviceLevel: "bulk",
                    numberOfCards: null,
                    needsCardSavers: false,
                    expedited: false,
                },
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
        methods: {
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
