<template>
    <div>
        <div
            v-if="submissions.data.length > 0"
            class="max-w-5xl px-4 py-6 mx-auto lg:px-8 sm:px-6 md:py-12"
        >
            <breeze-table>
                <template v-slot:table-head>
                    <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                        <span class="hidden md:block">Submission ID</span>
                        <span class="block md:hidden">ID</span>
                    </th>
                    <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                        <span class="hidden md:block">Sub Creation Date</span>
                        <span class="block md:hidden">Date</span>
                    </th>
                    <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                        <span class="hidden md:block">Number of Cards</span>
                        <span class="block md:hidden">Cards</span>
                    </th>
                    <th class="px-3 py-2 text-right uppercase md:px-6 md:py-4">
                        <span class="block">Actions</span>
                    </th>
                </template>
                <template v-slot:table-body>
                    <tr
                        v-for="submission in submissions.data"
                        :key="submission.sub_id"
                    >
                        <td
                            class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                        >
                            <div class="flex items-center">
                                <div class="w-16 h-16 mr-4">
                                    <img
                                        :src="submission.pokemonSprite"
                                        alt="pokemon sprite"
                                        class="object-contain w-full h-full"
                                    />
                                </div>
                                {{ submission.sub_id }}
                            </div>
                        </td>
                        <td
                            class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                        >
                            {{ $filters.dateTimestamp(submission.created_at) }}
                        </td>
                        <td
                            class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                        >
                            {{ submission.number_of_cards }}
                        </td>
                        <td
                            class="flex justify-end h-full px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                        >
                            <div class="flex items-center space-x-4">
                                <!-- Details -->
                                <breeze-button
                                    @click.prevent="
                                        handleShowSubmission(submission)
                                    "
                                    class="items-center hidden md:flex"
                                    width="auto"
                                    size="small"
                                    color="darkBlue"
                                >
                                    <search-icon class="w-4 h-4" />
                                    <span class="inline-block ml-4">
                                        Details
                                    </span>
                                </breeze-button>
                                <breeze-button
                                    @click.prevent="
                                        handleShowSubmission(submission)
                                    "
                                    class="flex items-center md:hidden"
                                    width="auto"
                                    size="auto"
                                    color="darkBlue"
                                >
                                    <search-icon class="w-4 h-4" />
                                </breeze-button>
                                <!-- Edit Submission -->
                                <inertia-link
                                    v-if="submission.status === 'created'"
                                    :href="`/middleman/submission/edit/${submission.id}`"
                                >
                                    <breeze-button
                                        class="items-center hidden md:flex"
                                        width="auto"
                                        size="small"
                                        color="lightBlue"
                                    >
                                        <edit-icon class="w-4 h-4" />
                                        <span class="inline-block ml-4">
                                            Edit
                                        </span>
                                    </breeze-button>
                                    <breeze-button
                                        class="flex items-center md:hidden"
                                        width="auto"
                                        size="auto"
                                        color="lightBlue"
                                    >
                                        <edit-icon class="w-4 h-4" />
                                    </breeze-button>
                                </inertia-link>
                                <!-- Cancel Submission -->
                                <breeze-button
                                    @click.prevent="
                                        handleShowCancelSubmissionModal(
                                            submission
                                        )
                                    "
                                    class="items-center hidden md:flex"
                                    width="auto"
                                    size="small"
                                    color="darkGray"
                                >
                                    <trash-icon class="w-4 h-4" />
                                    <span class="inline-block ml-4">
                                        Cancel
                                    </span>
                                </breeze-button>
                                <breeze-button
                                    @click.prevent="
                                        handleShowCancelSubmissionModal(
                                            submission
                                        )
                                    "
                                    class="flex items-center md:hidden"
                                    width="auto"
                                    size="auto"
                                    color="darkGray"
                                >
                                    <trash-icon class="w-4 h-4" />
                                </breeze-button>
                            </div>
                        </td>
                    </tr>
                </template>
            </breeze-table>

            <!-- Pagination -->
            <breeze-pagination
                :pagination="submissions"
                @previous="handlePagination('prev')"
                @next="handlePagination('next')"
            />
        </div>

        <div
            v-else
            class="max-w-5xl px-4 py-12 mx-auto sm:px-6 lg:px-8 md:py-24"
        >
            <h2>No Submissions Found</h2>
            <p>
                Looks like you don't have any submissions. Go to the New
                Submissions page and fill out the form to get started.
            </p>
        </div>

        <submission-detail-modal
            :show-modal="showModal"
            @close="handleCloseModal"
            :active-submission="activeSubmission"
            :statuses="statuses"
        />

        <!-- Cancel Modal -->
        <breeze-modal :open="showCancelModal" @close="handleCloseCancelModal">
            <h2 class="text-xl">
                Cancel Submission - {{ this.cancelledSubmission.sub_id }}
            </h2>
            <p class="mt-2 text-left">
                Are you sure you want to cancel this submission? You will not be
                able to undo this action.
            </p>

            <div class="mt-6">
                <a
                    :href="`/middleman/submission/${this.cancelledSubmission.id}/cancel`"
                    class="cursor-pointer"
                >
                    <breeze-button
                        :no-click="true"
                        size="small"
                        color="darkBlue"
                        class="w-full cursor-pointer sm:w-auto"
                    >
                        Cancel Submission</breeze-button
                    >
                </a>
            </div>
        </breeze-modal>
    </div>
</template>

<script>
    import BreezeTable from "@/Components/Table";
    import BreezePagination from "@/Components/Pagination";
    import BreezeButton from "@/Components/Button";
    import BreezeModal from "@/Components/Modal";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import TrashIcon from "@/Components/Icons/TrashIcon";
    import EditIcon from "@/Components/Icons/EditIcon";
    import SubmissionDetailModal from "@/Components/middleman/SubmissionDetailModal";

    export default {
        components: {
            BreezeTable,
            BreezePagination,
            BreezeButton,
            BreezeModal,
            SearchIcon,
            TrashIcon,
            EditIcon,
            SubmissionDetailModal,
        },
        props: {
            submissions: {
                type: Object,
                required: false,
            },
            statuses: {
                type: Array,
                required: false,
            },
            auth: Object,
        },
        data() {
            return {
                activeSubmission: null,
                showModal: false,
                // Cancelled
                cancelledSubmission: null,
                showCancelModal: false,
            };
        },
        methods: {
            handlePagination(direction) {
                const endpoint =
                    direction === "next"
                        ? this.submissions.next_page_url
                        : this.submissions.prev_page_url;
                this.$inertia.get(endpoint);
            },
            handleShowSubmission(submission) {
                this.activeSubmission = submission;
                this.showModal = true;
            },
            handleCloseModal() {
                this.activeSubmission = null;
                this.showModal = false;
            },
            /**
             * Cancel a submission
             */
            handleShowCancelSubmissionModal(submission) {
                this.cancelledSubmission = submission;
                this.showCancelModal = true;
            },
            handleCloseCancelModal() {
                this.cancelledSubmission = null;
                this.showCancelModal = false;
            },
        },
    };
</script>
