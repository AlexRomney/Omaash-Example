<template>
    <breeze-alert
        v-if="hasErrors"
        type="error"
        title=" Whoops! Something went wrong."
    >
        <template #customDescription>
            <ul class="mt-2 text-sm list-disc list-inside">
                <li
                    v-for="(error, key) in errors"
                    :key="key"
                    class="font-bold text-red-700"
                >
                    {{ error }}
                </li>
            </ul>
        </template>
    </breeze-alert>
</template>

<script>
    import BreezeAlert from "@/Components/Alert";

    export default {
        name: "ValidationErrors",
        components: {
            BreezeAlert,
        },
        computed: {
            errors() {
                return this.$page.props.errors;
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        },
    };
</script>
