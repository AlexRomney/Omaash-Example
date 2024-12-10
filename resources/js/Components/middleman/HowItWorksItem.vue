<template>
    <div>
        <dt>
            <breeze-button
                class="absolute flex items-center justify-center w-12 h-12"
                width="auto"
                size="auto"
                :no-click="true"
                color="darkBlue"
                ><div class="w-6 h-6 text-xl align-middle font-bungee">
                    {{ step }}
                </div>
            </breeze-button>
            <h4 class="ml-16 text-lg font-medium leading-6">{{ title }}</h4>
        </dt>
        <dd class="mt-2 ml-16 text-base">
            <slot name="description" />
        </dd>
    </div>
</template>

<script>
    import BreezeButton from "@/Components/Button";

    export default {
        props: {
            step: {
                type: String,
                required: true,
            },
            title: {
                type: String,
                required: true,
            },
        },
        components: {
            BreezeButton,
        },
    };
</script>
