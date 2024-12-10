<template>
    <nav class="flex flex-col items-center justify-between mt-12 sm:flex-row">
        <div>
            <p class="font-bungee text-lightBlue">
                Showing
                <span class="font-medium">{{ pagination.from }}</span>
                to

                <span class="font-medium">{{ pagination.to }}</span>
                of
                <span class="font-medium">{{ pagination.total }}</span>
                results
            </p>
        </div>
        <div
            class="flex justify-between flex-1 mt-6 space-x-6 sm:mt-0 sm:justify-end"
        >
            <breeze-button
                @click.prevent="$emit('previous')"
                :disabled="!pagination.prev_page_url"
                width="small"
                size="small"
                color="lightBlue"
            >
                Previous
            </breeze-button>
            <breeze-button
                @click.prevent="$emit('next')"
                :disabled="!pagination.next_page_url"
                width="small"
                size="small"
                color="lightBlue"
            >
                Next
            </breeze-button>
        </div>
    </nav>
</template>

<script>
    import BreezeButton from "@/Components/Button";

    export default {
        components: {
            BreezeButton,
        },
        props: {
            pagination: {
                type: Object,
                required: true,
            },
        },
    };
</script>
