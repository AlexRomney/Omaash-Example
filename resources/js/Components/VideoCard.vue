<template>
    <div
        class="relative h-full transition-all duration-300 ease-in-out cursor-pointer transform-none md:transform md:hover:scale-105"
    >
        <div class="bg-cover aspect-w-16 aspect-h-9">
            <img
                :src="video.snippet.thumbnails.medium.url"
                :alt="video.snippet.title"
            />
        </div>
        <div class="z-10 mx-6 -mt-6 shadow-lg">
            <div class="relative z-10 min-w-0 p-4 bg-white">
                <h3
                    class="leading-snug font-bungee line-clamp-2"
                    v-html="video.snippet.title"
                />
                <!-- <p class="mt-2 text-sm line-clamp-2">
                    {{ video.snippet.description }}
                </p> -->
                <div class="mt-4 text-sm text-lightBlue">
                    {{ formattedDate }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            video: {
                type: Object,
                required: true,
            },
        },
        computed: {
            formattedDate() {
                const date = new Date(this.video.snippet.publishedAt);
                const options = {
                    weekday: "long",
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                };

                return date.toLocaleDateString(undefined, options);
            },
        },
    };
</script>
