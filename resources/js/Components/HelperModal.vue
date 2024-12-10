<template>
    <div class="flex items-center">
        <button
            @click.stop.prevent="showInfoModal = !showInfoModal"
            type="button"
            :class="[bgClass, simple ? 'pr-1 p-1' : 'p-1 pr-2']"
            class="inline-flex items-center text-xs shadow-lg text-lightBlue focus:ring-2 focus:ring-lightBlue focus:outline-none"
        >
            <span v-if="!hideIcon" class="p-1 bg-white">
                <question-solid-icon
                    class="w-3 h-3 fill-current text-lightBlue"
                />
            </span>
            <span
                v-if="!simple"
                :class="size === 'small' ? 'text-xs' : 'text-sm'"
                class="ml-2 leading-5 whitespace-nowrap"
            >
                {{ btnText || "More Info" }}
            </span>
        </button>

        <breeze-modal :open="showInfoModal" @close="showInfoModal = false">
            <div class="flex">
                <breeze-button class="mr-6 sm:mr-8" width="auto" size="auto">
                    <info-circle-icon
                        class="w-6 h-6 fill-current sm:w-8 sm:h-8 text-lightBlue"
                    />
                </breeze-button>
                <div>
                    <slot />
                </div>
            </div>
        </breeze-modal>
    </div>
</template>

<script>
    import InfoCircleIcon from "@/Components/Icons/InfoCircleIcon";
    import QuestionSolidIcon from "@/Components/Icons/QuestionSolidIcon";
    import BreezeModal from "@/Components/Modal";
    import BreezeButton from "@/Components/Button";

    export default {
        components: {
            BreezeModal,
            InfoCircleIcon,
            QuestionSolidIcon,
            BreezeButton,
        },
        props: {
            btnText: {
                type: String,
                default: () => "",
                required: false,
            },
            simple: {
                type: Boolean,
                default: () => false,
                required: false,
            },
            bgClass: {
                type: String,
                default: () => "bg-medGray",
                required: false,
            },
            size: {
                type: String,
                default: () => "regular",
                validator(value) {
                    return ["small", "regular"].includes(value);
                },
            },
            hideIcon: {
                type: Boolean,
                default: () => false,
                required: false,
            },
        },
        data() {
            return {
                showInfoModal: false,
            };
        },
    };
</script>
