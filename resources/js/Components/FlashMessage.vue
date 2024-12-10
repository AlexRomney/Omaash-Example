<template>
    <div
        v-if="flash && flash.success && show"
        class="fixed top-0 right-0 z-50 p-4 mx-6 mt-6 font-bold text-left text-green-500 transition duration-300 ease-in-out border-4 border-current border-green-500 shadow-lg sm:w-auto bg-green-50 flash all"
    >
        {{ flash.success }}
    </div>
    <div
        v-if="flash && flash.error && show"
        class="fixed top-0 right-0 z-50 p-4 mx-6 mt-6 font-bold text-left text-red-500 transition duration-300 ease-in-out border-4 border-current border-red-500 shadow-lg sm:w-auto bg-red-50 flash all"
    >
        {{ flash.error }}
    </div>
    <div
        v-if="flash && flash.warning && show"
        class="fixed top-0 right-0 z-50 p-4 mx-6 mt-6 font-bold text-left text-yellow-500 transition duration-300 ease-in-out border-4 border-current border-yellow-500 shadow-lg sm:w-auto bg-yellow-50 flash all"
    >
        {{ flash.warning }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: false,
            };
        },
        watch: {
            flash: {
                handler(val, oldVal) {
                    this.show = true;
                    setTimeout(() => {
                        this.show = false;
                    }, 3000);
                },
                deep: true,
                immediate: true,
            },
        },
        computed: {
            flash() {
                return this.$page.props.flash;
            },
        },
        mounted() {},
    };
</script>

<style scoped>
    .flash {
        animation: goIn 0.5s ease-in-out;
        padding: 8px 16px;
        box-shadow: 0px 0px, 1px 1px, 2px 2px, 3px 3px, 4px 4px, 5px 5px,
            6px 6px;
        margin-bottom: 6px;
    }

    @keyframes goIn {
        0% {
            opacity: 0;
            transform: translateX(300px);
        }
        100% {
            opacity: 1;
            transform: translateX(0px);
        }
    }
    @keyframes goOut {
        0% {
            opacity: 1;
            transform: translateX(0px);
        }
        100% {
            opacity: 0;
            transform: translateX(300px);
        }
    }
</style>
