<template>
    <inertia-link
        :href="href"
        :class="classes"
        class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out hover:text-lightBlue font-bungee focus:outline-none"
    >
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        props: ["href", "active"],

        computed: {
            classes() {
                return this.active ? "text-lightBlue" : "text-darkBlue";
            },
        },
    };
</script>
