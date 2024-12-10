<template>
    <breeze-layout bg-class="bg-videos" header-size="small">
        <template #header>
            <h2 class="text-4xl text-center text-white">Omaash Videos</h2>
        </template>

        <div>
            <!-- Featured Video Section -->
            <!-- <section class="py-12 bg-lightGray">
                <div
                    v-if="featuredVideo"
                    class="grid grid-cols-1 gap-12 px-4 mx-auto lg:grid-cols-2 max-w-7xl sm:px-6 lg:px-8"
                >
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe
                            :src="youtubeEmbedUrl + featuredVideo.id.videoId"
                            :title="featuredVideo.snippet.title"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                        <h2 class="text-3xl">
                            {{ featuredVideo.snippet.title }}
                        </h2>
                        <p class="mt-4">
                            {{ featuredVideo.snippet.description }}
                        </p>
                        <a
                            :href="youtubeUrl + featuredVideo.id.videoId"
                            target="_blank"
                            class="mt-6"
                        >
                            <breeze-button color="youtube">
                                Watch on Youtube
                            </breeze-button>
                        </a>
                    </div>
                </div>
            </section> -->

            <section
                class="gap-12 px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8"
            >
                <div
                    class="grid grid-cols-1 gap-12 mx-auto lg:grid-cols-3 max-w-7xl"
                >
                    <div
                        class="flex flex-col items-center w-full sm:flex-row lg:col-span-2"
                    >
                        <!-- Search Bar -->
                        <form
                            @submit.prevent="submitSearch"
                            class="w-full h-full"
                        >
                            <div class="flex items-center h-full">
                                <breeze-input
                                    ref="searchQuery"
                                    id="searchQuery"
                                    type="text"
                                    class="self-stretch block w-full h-full -mr-2"
                                    v-model="form.searchQuery"
                                    required
                                />

                                <breeze-button
                                    width="auto"
                                    size="small"
                                    class="flex items-center"
                                >
                                    <search-icon class="w-4 h-4" />
                                    <span class="hidden ml-2 sm:inline-block"
                                        >Search</span
                                    >
                                </breeze-button>
                            </div>
                        </form>
                        <breeze-button
                            @click.prevent="resetSearch"
                            class="hidden ml-4 sm:block"
                            width="auto"
                            size="small"
                            color="darkGray"
                            >Reset</breeze-button
                        >
                        <breeze-button
                            @click.prevent="resetSearch"
                            class="w-full mt-4 sm:hidden"
                            width="full"
                            size="small"
                            color="darkGray"
                            >Reset</breeze-button
                        >
                    </div>
                    <div
                        v-if="videos.pageInfo"
                        class="flex items-end justify-end lg:col-span-1"
                    >
                        <p class="font-bungee">
                            Showing {{ videos.pageInfo.resultsPerPage }} of
                            {{ videos.pageInfo.totalResults }}
                            videos
                        </p>
                    </div>
                </div>

                <!-- Results -->
                <div
                    class="grid items-center justify-center grid-cols-1 gap-12 py-12 lg:grid-cols-3"
                >
                    <video-card
                        :video="video"
                        v-for="video in videos.items"
                        :key="video.etag"
                        @click.prevent="handleModalOpen(video)"
                    />
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-end space-x-6">
                    <breeze-button
                        :disabled="!videos.prevPageToken"
                        @click.prevent="handlePagination('prev')"
                        width="auto"
                        size="small"
                        >Previous</breeze-button
                    >
                    <breeze-button
                        :disabled="!videos.nextPageToken"
                        @click.prevent="handlePagination('next')"
                        width="auto"
                        size="small"
                        >Next</breeze-button
                    >
                </div>
            </section>
        </div>
    </breeze-layout>

    <breeze-modal :open="showModal" @close="handleModalClose">
        <div class="aspect-w-16 aspect-h-9 bg-lightGray">
            <iframe
                :src="youtubeEmbedUrl + activeModalVideo.id.videoId"
                :title="activeModalVideo.snippet.title"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            />
        </div>
        <h3 class="mt-6 text-3xl" v-html="activeModalVideo.snippet.title" />
        <p class="mt-2 text-left">
            {{ activeModalVideo.snippet.description }}
        </p>
        <div
            v-if="activeModalVideo.snippet.publishedAt"
            class="mt-4 text-sm text-lightBlue"
        >
            {{ formattedDate }}
        </div>
        <a :href="youtubeUrl + activeModalVideo.id.videoId" target="_blank">
            <breeze-button color="youtube" class="mt-6"
                >Subscribe</breeze-button
            >
        </a>
    </breeze-modal>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import BreezeButton from "@/Components/Button";
    import BreezeAlert from "@/Components/Alert";
    import BreezeInput from "@/Components/Input";
    import BreezeModal from "@/Components/Modal";
    import SearchIcon from "@/Components/Icons/SearchIcon";
    import VideoCard from "@/Components/VideoCard";

    export default {
        components: {
            BreezeLayout,
            BreezeButton,
            BreezeAlert,
            BreezeInput,
            BreezeModal,
            SearchIcon,
            VideoCard,
        },
        props: {
            videos: Object,
            auth: Object,
            errors: Object,
            flash: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    searchQuery: "",
                    pageToken: "",
                }),
                youtubeUrl: "https://www.youtube.com/watch?v=",
                youtubeEmbedUrl: "https://www.youtube.com/embed/",
                // Modal
                showModal: false,
                activeModalVideo: {},
                // Featured Video in local storage
                featuredVideo: null,
            };
        },
        mounted() {
            this.$refs.searchQuery.focus();
        },
        // created() {
        //     this.handleLocalStorageFeaturedVideo();
        // },
        computed: {
            formattedDate() {
                const date = new Date(
                    this.activeModalVideo.snippet.publishedAt
                );
                const options = {
                    weekday: "long",
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                };

                return date.toLocaleDateString(undefined, options);
            },
        },
        methods: {
            // handleLocalStorageFeaturedVideo() {
            //     localStorage.setItem(
            //         "featuredVideo",
            //         JSON.stringify(this.videos.items[0])
            //     );
            //     let featuredVideo = localStorage.getItem("featuredVideo");
            //     this.featuredVideo = JSON.parse(featuredVideo);
            // },
            submitSearch() {
                this.form.get("/omaash/videos", {
                    params: {
                        searchQuery: this.form.searchQuery,
                        pageToken: this.form.pageToken,
                    },
                    preserveScroll: true,
                    onFinish: () => this.form.reset("searchQuery", "pageToken"),
                });
            },
            resetSearch() {
                this.form.get("/omaash/videos", {
                    params: {
                        searchQuery: "",
                        pageToken: "",
                    },
                    preserveScroll: true,
                    onFinish: () => this.form.reset("searchQuery", "pageToken"),
                });
            },
            handlePagination(direction) {
                if (direction === "next") {
                    this.form.pageToken = this.videos.nextPageToken;
                } else {
                    this.form.pageToken = this.videos.prevPageToken;
                }
                this.submitSearch();
            },
            handleModalOpen(video) {
                this.showModal = true;
                this.activeModalVideo = video;
            },
            handleModalClose() {
                this.activeModalVideo = {};
                this.showModal = false;
            },
        },
    };
</script>
