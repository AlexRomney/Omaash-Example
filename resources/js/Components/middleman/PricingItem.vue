<template>
    <div class="shadow-lg bg-medGray">
        <div class="p-6">
            <a :href="item.url" target="_blank">
                <breeze-button
                    class="text-2xl"
                    width="full"
                    size="regular"
                    color="lightBlue"
                >
                    {{ propertyName }}
                </breeze-button>
            </a>

            <ul role="list" class="mt-6 space-y-4">
                <li
                    v-for="(value, property) in item.prices"
                    :key="value"
                    class="flex items-center space-x-3"
                >
                    <h5 class="font-bold text-lightBlue">
                        ${{ formattedValue(value) }}
                    </h5>
                    <span class="whitespace-nowrap">{{
                        $filters.allCapitalized(property)
                    }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";

    export default {
        components: {
            BreezeButton,
        },
        props: {
            item: {
                type: Object,
                required: true,
            },
            propertyName: {
                type: String,
                required: true,
            },
        },
        methods: {
            formattedValue(value) {
                return value.toLocaleString("en-us");
            },
        },
    };
</script>
