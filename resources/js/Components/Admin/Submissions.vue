<template>
    <div
        class="grid max-w-5xl grid-cols-1 gap-6 px-4 pt-0 mx-auto md:pt-12 md:gap-12 lg:px-8 sm:px-6 lg:grid-cols-3"
    >
        <div class="flex items-center w-full lg:flex-row lg:col-span-2">
            <!-- Search Bar -->
            <form @submit.prevent="submitSearch" class="w-full h-full">
                <div class="flex items-center h-full">
                    <breeze-input
                        v-if="toggleSearchType"
                        ref="query"
                        id="query"
                        type="text"
                        placeholder="Search by user id or sub id"
                        class="z-10 self-stretch block w-full h-full"
                        v-model="form.query"
                        required
                    />
                    <div
                        v-else
                        id="search-datepicker"
                        class="block w-full h-full self-strech"
                    >
                        <datepicker
                            ref="query"
                            typeable
                            placeholder="Search by date"
                            class="z-10 self-stretch block w-full h-full border border-darkGray focus:border-lightBlue focus:ring focus:ring-lightBlue focus:ring-opacity-25"
                            style="height: 100%"
                            v-model="form.query"
                        />
                    </div>

                    <breeze-button
                        width="auto"
                        size="small"
                        class="z-20 flex items-center -ml-2"
                    >
                        <search-icon v-if="toggleSearchType" class="w-4 h-4" />
                        <calendar-icon v-else class="w-4 h-4" />
                        <span
                            v-if="toggleSearchType"
                            class="hidden ml-2 lg:inline-block"
                            >Text Search</span
                        >
                        <span v-else class="hidden ml-2 lg:inline-block"
                            >Date Search</span
                        >
                    </breeze-button>
                </div>
            </form>

            <breeze-button
                @click.prevent="handleToggle"
                class="flex items-center mt-0 ml-4"
                width="auto"
                size="small"
                color="lightBlue"
            >
                <toggle-icon class="w-4 h-4" />
                <span class="hidden ml-2 lg:inline-block">Toggle</span>
            </breeze-button>
        </div>
        <breeze-button
            @click.prevent="resetSearch"
            class="w-auto mt-0 lg:hidden"
            width="full"
            size="small"
            color="darkGray"
            >Reset</breeze-button
        >
        <breeze-button
            @click.prevent="resetSearch"
            class="hidden w-auto mt-0 ml-auto lg:block"
            width="full"
            size="small"
            color="darkGray"
            >Reset</breeze-button
        >
    </div>

    <div
        v-if="submissions.data.length > 0"
        class="max-w-5xl px-4 py-6 mx-auto lg:px-8 sm:px-6 md:py-12"
    >
        <breeze-table>
            <template v-slot:table-head>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Actions</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Submission ID</span>
                    <span class="block md:hidden">ID</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">User ID</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Company</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Service Level</span>
                    <span class="block md:hidden">Service</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Status</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Number of Cards</span>
                    <span class="block md:hidden">Cards</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Card Savers</span>
                    <span class="block md:hidden">Savers</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Card Saver Fee</span>
                    <span class="block md:hidden">Saver Fee</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Grading Fee</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Omaash Fee</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Shipping Fee</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Auction Off?</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Auction Company</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Expedited?</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Paid</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Completed</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Completed Date</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Send Off Date</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Tracking Number</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Accepted Terms Date</span>
                    <span class="block md:hidden">Terms Date</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="block">Note</span>
                </th>
                <th class="px-3 py-2 uppercase md:px-6 md:py-4">
                    <span class="hidden md:block">Sub Creation Date</span>
                    <span class="block md:hidden">Date</span>
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
                        <a
                            @click.prevent="editSubmission(submission.id)"
                            class="text-sm cursor-pointer font-bungee text-lightBlue"
                            >Edit</a
                        >
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ submission.sub_id }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        <a
                            @click.prevent="
                                handleUserDetailsModal(submission.user_id)
                            "
                            class="text-sm cursor-pointer font-bungee text-lightBlue"
                            >{{ submission.user_id }}</a
                        >
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.allCaps(submission.company) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.uppercase(submission.service_level) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.allCaps(submission.status) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.uppercase(submission.number_of_cards) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{
                            $filters.booleanYesNo(submission.needs_card_savers)
                        }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        <span v-if="submission.card_saver_fee"
                            >${{
                                $filters.number(submission.card_saver_fee)
                            }}</span
                        >
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        ${{ $filters.number(submission.grading_fee) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        ${{ $filters.number(submission.my_fee) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        <span v-if="submission.shipping_fee"
                            >${{
                                $filters.number(submission.shipping_fee)
                            }}</span
                        >
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.booleanYesNo(submission.auction_off) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >   
                        <span v-if="submission.auction_company">
                            {{ $filters.allCaps(submission.auction_company) }}
                        </span>
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.booleanYesNo(submission.expedited) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.booleanYesNo(submission.paid) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.booleanYesNo(submission.completed) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.dateTimestamp(submission.completed_date) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.dateTimestamp(submission.send_off_date) }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ submission.tracking_number }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{
                            $filters.dateTimestamp(
                                submission.accepted_terms_date
                            )
                        }}
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        <a
                            v-if="submission.note"
                            @click.prevent="showNote(submission.note)"
                            class="text-sm cursor-pointer font-bungee text-lightBlue"
                            >View Note</a
                        >
                    </td>
                    <td
                        class="px-3 py-2 text-sm md:px-6 md:py-4 md:text-lg text-darkGray whitespace-nowrap"
                    >
                        {{ $filters.dateTimestamp(submission.created_at) }}
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
        class="max-w-xl px-4 py-12 mx-auto text-center sm:px-6 lg:px-8 md:py-24"
    >
        <h2>No Submissions Found</h2>
        <p>Looks like are no new Omaash submissions.</p>
    </div>

    <breeze-modal :open="showNoteModal" @close="clearNote">
        <h3 class="text-3xl">Submission Note</h3>
        <p class="mt-2 text-left">
            {{ activeNote }}
        </p>
    </breeze-modal>

    <breeze-modal
        :open="showUserDetailsModal"
        @close="handleCloseUserDetailsModal"
    >
        <div v-if="userDetails">
            <h2 class="text-xl">
                {{ userDetails.first_name }} {{ userDetails.last_name }}
            </h2>
            <dl class="pt-6 font-bold divide-y divide-lightGray">
                <div
                    v-if="userDetails.id"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        User ID
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ userDetails.id }}
                    </dd>
                </div>
                <div
                    v-if="userDetails.username"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Username
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ userDetails.username }}
                    </dd>
                </div>
                <div
                    v-if="userDetails.email"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Email Address
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ userDetails.email }}
                    </dd>
                </div>
                <!-- International Address -->
                <div v-if="userDetails.international_address">
                    <div class="flex justify-between py-2 sm:px-4 md:px-6">
                        <dt class="pr-2 text-darkBlue whitespace-nowrap">
                            International Address
                        </dt>
                        <dd class="min-w-0 truncate text-darkGray">
                            {{ userDetails.international_address }}
                        </dd>
                    </div>
                </div>
                <!-- Normal Address -->
                <div v-else>
                    <div
                        v-if="userDetails.address"
                        class="flex justify-between py-2 sm:px-4 md:px-6"
                    >
                        <dt class="pr-2 text-darkBlue whitespace-nowrap">
                            Address
                        </dt>
                        <dd class="min-w-0 truncate text-darkGray">
                            {{ userDetails.address }}
                        </dd>
                    </div>
                    <div
                        v-if="userDetails.city"
                        class="flex justify-between py-2 sm:px-4 md:px-6"
                    >
                        <dt class="pr-2 text-darkBlue whitespace-nowrap">
                            City
                        </dt>
                        <dd class="min-w-0 truncate text-darkGray">
                            {{ $filters.uppercase(userDetails.city) }}
                        </dd>
                    </div>
                    <div
                        v-if="userDetails.state"
                        class="flex justify-between py-2 sm:px-4 md:px-6"
                    >
                        <dt class="pr-2 text-darkBlue whitespace-nowrap">
                            State
                        </dt>
                        <dd class="min-w-0 truncate text-darkGray">
                            {{ $filters.allCaps(userDetails.state) }}
                        </dd>
                    </div>
                    <div
                        v-if="userDetails.zip"
                        class="flex justify-between py-2 sm:px-4 md:px-6"
                    >
                        <dt class="pr-2 text-darkBlue whitespace-nowrap">
                            Zip Code
                        </dt>
                        <dd class="min-w-0 truncate text-darkGray">
                            {{ userDetails.zip }}
                        </dd>
                    </div>
                </div>
                <!-- Contact Type -->
                <div
                    v-if="userDetails.contact_type"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Contact Type
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ $filters.uppercase(userDetails.contact_type) }}
                    </dd>
                </div>
                <!-- Contact Handle -->
                <div
                    v-if="userDetails.contact_handle"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Contact Handle
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ $filters.uppercase(userDetails.contact_handle) }}
                    </dd>
                </div>
                <!-- Payment Type -->
                <div
                    v-if="userDetails.payment_type"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Payment Type
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ $filters.uppercase(userDetails.payment_type) }}
                    </dd>
                </div>
                <!-- Banned -->
                <div
                    v-if="userDetails.banned"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">Banned</dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ $filters.booleanYesNo(userDetails.banned) }}
                    </dd>
                </div>
                <!-- Created Date -->
                <div
                    v-if="userDetails.created_at"
                    class="flex justify-between py-2 sm:px-4 md:px-6"
                >
                    <dt class="pr-2 text-darkBlue whitespace-nowrap">
                        Register Date
                    </dt>
                    <dd class="min-w-0 truncate text-darkGray">
                        {{ $filters.dateTimestamp(userDetails.created_at) }}
                    </dd>
                </div>
            </dl>
        </div>
    </breeze-modal>
</template>

<script>
    import axios from "axios";

    import Datepicker from "vue3-datepicker";

    import BreezeTable from "@/Components/Table";
    import BreezePagination from "@/Components/Pagination";
    import BreezeInput from "@/Components/Input";
    import BreezeButton from "@/Components/Button";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import CalendarIcon from "@/Components/Icons/CalendarIcon";
    import ToggleIcon from "@/Components/Icons/ToggleIcon";
    import BreezeModal from "@/Components/Modal";

    export default {
        components: {
            BreezeTable,
            BreezePagination,
            BreezeInput,
            BreezeButton,
            SearchIcon,
            CalendarIcon,
            ToggleIcon,
            BreezeModal,
            Datepicker,
        },
        props: {
            submissions: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    query: null,
                }),
                toggleSearchType: true,
                // Note stuff
                showNoteModal: false,
                activeNote: "",
                // User Details
                showUserDetailsModal: false,
                userDetails: null,
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
            submitSearch() {
                let newQuery;
                if (this.toggleSearchType) {
                    newQuery = this.form.query;
                } else {
                    newQuery = new Date(
                        this.form.query -
                            this.form.query.getTimezoneOffset() * 60 * 1000
                    )
                        .toISOString()
                        .split("T")[0];
                }
                this.$inertia.get("/admin/middleman/submissions", {
                    query: newQuery,
                    preserveScroll: true,
                    onFinish: () => {
                        this.toggleSearchType = true;
                        this.form.query = null;
                    },
                });
            },
            resetSearch() {
                this.form.get("/admin/middleman/submissions", {
                    params: {
                        query: null,
                    },
                    preserveScroll: true,
                    onFinish: () => {
                        this.toggleSearchType = true;
                        this.form.query = null;
                    },
                });
            },
            handleToggle() {
                this.form.query = null;
                this.toggleSearchType = !this.toggleSearchType;
            },
            /**
             * Note Modal
             */
            showNote(note) {
                this.activeNote = note;
                this.showNoteModal = true;
            },
            clearNote() {
                this.activeNote = "";
                this.showNoteModal = false;
            },
            /**
             * Edit Submission
             */
            editSubmission(id) {
                this.$inertia.visit(`/admin/middleman/submission/edit/${id}`, {
                    preserveState: true,
                });
            },
            /**
             * Show User Info Modal
             */
            handleUserDetailsModal(user_id) {
                axios
                    .get(`/admin/users/get-user/${user_id}`)
                    .then((response) => {
                        this.userDetails = response.data.user;
                        this.showUserDetailsModal = true;
                    });
            },
            handleCloseUserDetailsModal() {
                this.showUserDetailsModal = false;
                this.userDetails = null;
            },
        },
    };
</script>

<style lang="css">
    #search-datepicker .v3dp__datepicker {
        width: 100% !important;
        height: 100% !important;
    }

    .v3dp__input_wrapper {
        height: 100% !important;
    }
</style>
