<template>
    <transition
        @enter="showContent = true"
        enter-active-class="transition duration-300 ease-out"
        leave-active-class="transition duration-200 ease-in"
        enter-class="opacity-0"
        leave-class="opacity-100"
        enter-to-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="open"
            class="fixed inset-x-0 bottom-0 flex flex-col justify-end h-full max-h-screen px-4 py-6 overflow-y-scroll z-60 sm:overflow-y-auto sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center"
        >
            <div
                @click.stop="handleBackgroundClose"
                class="fixed inset-0 transition-opacity cursor-pointer"
            >
                <div class="fixed inset-0 opacity-75 bg-darkBlue z-70" />
            </div>

            <transition
                @leave="$emit('close')"
                enter-active-class="transition duration-500 ease-out"
                leave-active-class="transition duration-300 ease-in"
                enter-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                leave-class="translate-y-0 opacity-100 sm:scale-100"
                enter-to-class="translate-y-0 opacity-100 sm:scale-100"
                leave-to-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            >
                <div
                    v-if="showContent"
                    :class="
                        transparentBg
                            ? 'bg-transparent max-w-md mx-auto'
                            : 'bg-white shadow-xl sm:max-w-3xl sm:w-full px-4 py-6 sm:px-6 sm:py-12'
                    "
                    class="relative mt-0 mb-0 overflow-y-scroll transition-all transform md:mt-48 md:overflow-y-visible sm:mb-12 sm:mt-12 z-80"
                >
                    <div
                        v-if="!hideClose"
                        class="absolute right-0 z-20 hidden -mt-6 -mr-4 top-1 md:block"
                    >
                        <breeze-button
                            width="auto"
                            size="auto"
                            @click.stop="showContent = false"
                        >
                            <close-icon class="w-6 h-6" />
                        </breeze-button>
                    </div>
                    <div class="">
                        <slot />
                        <div class="w-full mt-12 md:hidden">
                            <div
                                class="text-center underline text-darkGray font-bungee"
                                @click.stop="showContent = false"
                            >
                                Close Modal
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import CloseIcon from "@/Components/Icons/CloseIcon";
    import BreezeButton from "@/Components/Button";

    export default {
        props: {
            open: {
                type: Boolean,
                required: true,
                default: () => false,
            },
            transparentBg: {
                type: Boolean,
                default: () => false,
            },
            hideClose: {
                type: Boolean,
                default: () => false,
            },
        },
        components: {
            CloseIcon,
            BreezeButton,
        },
        data() {
            return {
                showContent: false,
            };
        },
        watch: {
            // showContent(newValue, oldValue) {
            //     if (newValue === true) {
            //         document.body.classList.add("modal-open");
            //     } else {
            //         document.body.classList.remove("modal-open");
            //     }
            // },
            // "$page.url": function (newUrl, oldUrl) {
            //     document.body.classList.remove("modal-open");
            // },
            open(newValue, oldValue) {
                if (newValue === true) {
                    document.body.classList.add("modal-open");
                } else {
                    document.body.classList.remove("modal-open");
                }
            },
            "$page.url": function (newUrl, oldUrl) {
                document.body.classList.remove("modal-open");
            },
        },
        methods: {
            handleBackgroundClose() {
                this.showContent = false;
                this.$emit("close");
            },
        },
    };
</script>
