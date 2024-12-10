<template>
    <inertia-link
        :class="classes"
        class="block py-2 pl-3 pr-4 text-base font-medium transition duration-150 ease-in-out font-bungee focus:outline-none focus:text-lightBlue focus:bg-lightBlue focus:border-lightBlue"
    >
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        props: ["active"],

        computed: {
            classes() {
                return this.active
                    ? "text-white bg-lightBlue"
                    : "text-darkBlue bg-white";
            },
        },
    };
</script>
