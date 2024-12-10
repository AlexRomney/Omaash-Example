<template>
    <div>
        <button
            @click.prevent="showCollapse = !showCollapse"
            class="flex items-center justify-between w-full p-4 text-left text-white shadow-lg bg-lightBlue font-bungee"
        >
            <span>
                {{ question }}
            </span>
            <div class="pl-6">
                <up-arrow-icon
                    class="w-4 h-4 text-white transition-all duration-200 ease-in-out transform rotate-90"
                    :class="{ 'rotate-180': showCollapse }"
                />
            </div>
        </button>
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div v-if="showCollapse" class="px-6 py-8 bg-white shadow-lg">
                <slot />
            </div>
        </transition>
    </div>
</template>

<script>
    import UpArrowIcon from "@/Components/Icons/UpArrowIcon";
    export default {
        components: {
            UpArrowIcon,
        },
        props: {
            showInitially: {
                type: Boolean,
                default: false,
            },
            question: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                showCollapse: false,
            };
        },
    };
</script>
