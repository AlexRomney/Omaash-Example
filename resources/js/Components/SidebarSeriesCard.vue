<template>
    <inertia-link :href="`/cards/sets#${slugifiedId}`" class="w-full">
        <div class="relative w-full">
            <div
                class="flex items-center p-3 rounded-sm cursor-pointer group hover:bg-lightBlue"
            >
                <div class="w-10 h-auto">
                    <img
                        :src="series.series_logo"
                        alt=""
                        class="object-contain w-10 h-auto"
                    />
                </div>
                <div class="ml-4 text-base font-bold group-hover:text-white">
                    {{
                        series.series === "Other"
                            ? "Promo"
                            : $filters.uppercase(series.series)
                    }}
                </div>
            </div>
        </div>
    </inertia-link>
</template>

<script>
    export default {
        props: {
            series: {
                type: Object,
                required: true,
            },
        },
        computed: {
            slugifiedId() {
                let string = this.series.series;
                string = string.toLowerCase();
                string = string.replace(/&/g, "and");
                string = string.replace(/|s/g, "-");
                string = string.replace(/[^a-z0-9]/g, "");
                return string;
            },
        },
    };
</script>
