<template>
    <div class="bg-lightGray">
        <div
            class="px-4 py-12 mx-auto max-w-7xl sm:px-6 sm:py-24 lg:px-8 md:grid md:grid-cols-2 md:gap-12 md:items-center"
        >
            <div>
                <h2 class="text-3xl">Submission Lookup</h2>
                <p class="mt-3 text-xl">
                    Check the status of your submission any time.
                </p>
            </div>
            <div>
                <div class="flex mt-8 md:mt-0 md:flex-shrink-0">
                    <form
                        @submit.prevent="handleSubmissionLookup"
                        class="w-full"
                    >
                        <div class="flex items-center h-full md:h-auto">
                            <breeze-input
                                id="searchQuery"
                                type="text"
                                class="self-stretch block w-full h-full -mr-4 md:h-auto"
                                v-model="form.subId"
                                placeholder="Search by unique submission ID"
                                required
                            />

                            <breeze-button
                                @click.prevent="handleSubmissionLookup"
                                class="flex items-center"
                                width="auto"
                                size="regular"
                                color="darkBlue"
                            >
                                <search-icon class="w-4 h-4 leading-normal" />
                            </breeze-button>
                        </div>
                    </form>
                </div>
                <p
                    v-if="submissionError"
                    class="block mt-2 text-sm text-red-600"
                    key="error"
                >
                    Looks like that submission id does not exist. Please try a
                    valid submission id.
                </p>
            </div>
        </div>

        <submission-detail-modal
            :show-modal="showModal"
            @close="handleCloseModal"
            :active-submission="activeSubmission"
            :statuses="statuses"
        />
    </div>
</template>

<script>
    import axios from "axios";
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import SubmissionDetailModal from "@/Components/middleman/SubmissionDetailModal";

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            SearchIcon,
            SubmissionDetailModal,
        },
        data() {
            return {
                form: this.$inertia.form({
                    subId: "",
                }),
                submissionError: false,
                activeSubmission: null,
                statuses: null,
                showModal: false,
            };
        },
        methods: {
            handleSubmissionLookup() {
                this.submissionError = false;
                axios
                    .get(`/middleman/submission/${this.form.subId}`)
                    .then((response) => {
                        if (response.data.submission) {
                            this.activeSubmission = response.data.submission;
                            this.statuses = response.data.statuses;
                            this.showModal = true;
                        } else {
                            this.submissionError = true;
                        }
                    })
                    .catch((err) => {
                        this.submissionError = true;
                    });
            },
            /**
             * Close the modal
             */
            handleCloseModal() {
                this.form.subId = "";
                this.form.reset("subId");
                this.showModal = false;
                this.activeSubmission = null;
            },
        },
    };
</script>
