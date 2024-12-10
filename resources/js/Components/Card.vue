<template>
    <div
        @click.prevent="$emit('show-card', card)"
        class="relative overflow-hidden transition-all duration-300 ease-in-out rounded-lg cursor-pointer transform-none md:transform md:hover:scale-105 sm:shadow-2xl"
    >
        <div class="w-full h-auto">
            <img
                :src="card.image_small"
                class="object-contain bg-medGray"
                loading="lazy"
            />
        </div>
        <div class="absolute bottom-0 left-0 right-0 hidden sm:block">
            <div
                class="relative w-3/4 h-4 -mb-1 bg-white md:w-2/3 lg:w-3/4 xl:w-4/5"
                style="clip-path: polygon(0 0, 85% 0, 100% 100%, 0 100%)"
            />
            <div class="relative px-2 py-2 leading-none truncate bg-white">
                <span
                    class="min-w-0 text-sm leading-none text-darkBlue font-bungee"
                >
                    {{ card.name }}
                </span>
            </div>
            <span
                class="absolute top-0 w-full min-w-0 px-2 pr-12 mt-2 leading-none truncate xl:pr-14 text-xxs text-darkGray font-bungee"
            >
                <span v-if="showSet" class="">
                    {{ card.set_name }}
                </span>
                <span v-else>
                    {{ card.rarity || "No Rarity" }}
                </span>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            card: Object,
            showSet: Boolean,
        },
    };
</script>
