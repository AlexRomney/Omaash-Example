<template>
    <div class="relative">
        <div :id="`${slugifiedId}`" class="anchor" />
        <div
            class="flex flex-col items-start justify-center py-4 mx-4 border-b-4 sm:items-center sm:justify-start sm:flex-row border-darkBlue sm:mx-6 lg:mx-8"
        >
            <img
                :src="sets[0].series_logo"
                :alt="sets[0].name"
                class="object-contain w-auto h-8 sm:h-10"
                loading="lazy"
            />
            <h4 class="text-base sm:text-2xl sm:ml-4">
                {{
                    seriesId === "Other"
                        ? "Promo"
                        : $filters.uppercase(seriesId)
                }}
            </h4>
        </div>

        <div
            class="grid min-w-0 grid-cols-1 gap-8 px-4 py-8 pb-16 truncate sm:grid-cols-2 md:grid-cols-3 sm:px-6 lg:px-8"
        >
            <set-card :set="set" v-for="set in sets" :key="set.id" />
        </div>
    </div>
</template>

<script>
    import SetCard from "@/Components/SetCard";

    export default {
        components: {
            SetCard,
        },
        props: {
            sets: {
                type: Object,
                required: true,
            },
            seriesId: {
                type: String,
                required: true,
            },
        },
        computed: {
            slugifiedId() {
                let string = this.seriesId;
                string = string.toLowerCase();
                string = string.replace(/&/g, "and");
                string = string.replace(/|s/g, "-");
                string = string.replace(/[^a-z0-9]/g, "");
                return string;
            },
        },
    };
</script>

<style lang="css" scoped>
    .anchor {
        display: block;
        position: relative;
        top: -6rem;
        visibility: hidden;
    }
</style>
