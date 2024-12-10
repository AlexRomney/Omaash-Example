<template>
    <transition
        mode="out-in"
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-if="show" class="w-full p-4" :class="backgroundColor">
            <div class="flex">
                <div class="flex flex-col w-full ml-3 text-left">
                    <h3
                        v-if="title"
                        class="text-md font-bungee"
                        :class="titleClass"
                    >
                        {{ title }}
                    </h3>
                    <div v-if="description" class="mt-2">
                        <p class="text-sm font-bold" :class="textClass">
                            {{ description }}
                        </p>
                    </div>
                    <div v-if="$slots.customDescription" class="mt-2">
                        <slot name="customDescription" />
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            show: {
                type: Boolean,
                default: true,
            },
            type: {
                type: String,
                required: true,
                default: () => "success",
            },
            title: {
                type: String,
                required: true,
                default: "",
            },
            description: {
                type: String,
                required: false,
            },
        },
        data() {
            return {
                backgroundColor: {
                    "bg-red-100": this.type === "error",
                    "bg-blue-100": this.type === "info",
                    "bg-green-100": this.type === "success",
                    "bg-yellow-100": this.type === "warning",
                },
                iconClass: {
                    "text-red-400": this.type === "error",
                    "text-blue-400": this.type === "info",
                    "text-green-400": this.type === "success",
                    "text-yellow-400": this.type === "warning",
                },
                titleClass: {
                    "text-red-900": this.type === "error",
                    "text-blue-900": this.type === "info",
                    "text-green-900": this.type === "success",
                    "text-yellow-900": this.type === "warning",
                },
                textClass: {
                    "text-red-700": this.type === "error",
                    "text-blue-700": this.type === "info",
                    "text-green-700": this.type === "success",
                    "text-yellow-700": this.type === "warning",
                },
            };
        },
    };
</script>
