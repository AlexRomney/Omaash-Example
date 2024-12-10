<template>
    <label class="block mb-2 text-xs font-medium font-bungee text-darkGray">
        <span v-if="value">{{ value }}</span>
        <slot v-else />
    </label>
</template>

<script>
    export default {
        props: ["value"],
    };
</script>
