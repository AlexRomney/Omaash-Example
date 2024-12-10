<template>
    <div class="p-2">
        <a :href="company.url" target="_blank">
            <breeze-button class="text-2xl" width="full" size="regular" color="lightBlue">
                {{ companyName }}
            </breeze-button>
        </a>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";
    
    export default {
        props: {
            company: {
                type: Object,
                required: true
            },
            companyName: {
                type: String,
                required: true
            }
        },
        components: {
            BreezeButton
        }
    }
</script>