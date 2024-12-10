<template>
    <a
        :href="`/cards/set/${set.id}`"
        class="relative h-full transition-all duration-300 ease-in-out cursor-pointer transform-none md:transform md:hover:scale-105"
    >
        <div class="pt-6 pb-10 bg-white border-2 shadow-2xl border-medGray">
            <div class="flex items-center justify-center bg-contain">
                <img
                    :src="set.image_logo"
                    :alt="set.name"
                    class="w-auto h-20 px-4"
                    loading="lazy"
                />
            </div>
        </div>
        <div class="z-10 mx-6 -mt-4 shadow-2xl">
            <div class="relative z-10 min-w-0 px-4 py-2 bg-darkBlue">
                <h3
                    class="text-sm leading-snug text-center text-white truncate whitespace-nowrap"
                >
                    {{ set.name }}
                </h3>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        props: {
            set: {
                type: Object,
                required: true,
            },
        },
    };
</script>
