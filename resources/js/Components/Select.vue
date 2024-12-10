<template>
    <select
        class="cursor-pointer border-darkGray focus:border-lightBlue focus:ring focus:ring-lightBlue focus:ring-opacity-25"
        :class="noBorder ? 'border-0' : 'border-1'"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
        <slot />
    </select>
</template>

<script>
    export default {
        props: {
            noBorder: {
                type: Boolean,
                default: false,
            },
            modelValue: {
                type: [String, Number],
                default: "",
            },
        },

        emits: ["update:modelValue"],

        methods: {
            focus() {
                this.$refs.input.focus();
            },
        },
    };
</script>
