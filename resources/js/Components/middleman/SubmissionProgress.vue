<template>
    <div
        class="flex flex-col items-start mt-6 space-y-1 md:items-center md:space-y-0 md:divide-x-2 md:justify-evenly md:flex-row md:divide-lightGray"
    >
        <!-- Desktop -->
        <div
            v-for="status in statuses"
            :key="status"
            class="relative flex-col items-center hidden w-full md:flex"
        >
            <!-- Active Button -->
            <breeze-button
                :no-click="true"
                v-if="status === currentStatus"
                class="z-10 mr-1.5 whitespace-nowrap"
                width="auto"
                size="small"
                color="lightBlue"
            >
                {{ status.toUpperCase() }}
            </breeze-button>
            <!-- Other -->
            <span
                v-else
                class="w-full p-2 text-xs text-center whitespace-nowrap font-bungee"
                :class="[
                    handleStepClass(status)
                        ? 'bg-darkBlue text-white'
                        : 'bg-darkGray text-white',
                ]"
            >
                {{ status.toUpperCase() }}
            </span>
        </div>

        <div class="grid w-full grid-cols-1 gap-2 md:hidden">
            <div
                v-for="status in statuses"
                :key="status"
                class="flex items-center w-full text-sm"
            >
                <span
                    v-if="status === currentStatus"
                    class="w-full py-1 border-l-4 border-lightBlue bg-lightBlue"
                >
                    <span class="pl-4 text-white font-bungee">
                        {{ status.toUpperCase() }}
                    </span>
                </span>
                <span
                    v-else
                    class="py-1 border-l-4"
                    :class="
                        handleStepClass(status)
                            ? 'text-darkBlue border-darkBlue'
                            : 'text-darkGray border-darkGray'
                    "
                >
                    <span class="pl-4 font-bungee">
                        {{ status.toUpperCase() }}
                    </span>
                </span>
            </div>
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
            statuses: {
                type: Array,
                required: true,
            },
            currentStatus: {
                type: String,
                required: true,
            },
        },
        methods: {
            handleStepClass(status) {
                return (
                    this.statuses.indexOf(this.currentStatus) >=
                    this.statuses.indexOf(status)
                );
            },
        },
    };
</script>
