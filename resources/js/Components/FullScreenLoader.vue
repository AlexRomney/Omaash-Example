<template>
    <transition
        enter-active-class="transition duration-300 ease-out"
        leave-active-class="transition duration-200 ease-in"
        enter-class="opacity-0"
        leave-class="opacity-100"
        enter-to-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="loading"
            class="fixed inset-x-0 bottom-0 flex flex-col justify-center h-full max-h-screen px-4 py-6 z-60 sm:inset-0 sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity">
                <div class="fixed inset-0 bg-white z-70" />
            </div>

            <transition
                enter-active-class="transition duration-500 ease-out"
                leave-active-class="transition duration-300 ease-in"
                enter-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                leave-class="translate-y-0 opacity-100 sm:scale-100"
                enter-to-class="translate-y-0 opacity-100 sm:scale-100"
                leave-to-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            >
                <div class="flex flex-col items-center justify-center z-80">
                    <div class="w-auto h-40">
                        <img
                            :src="`/images/loading/${loadingImg}`"
                            class="object-contain w-auto h-40"
                        />
                    </div>
                    <div
                        class="mt-4 text-xl text-center text-lightBlue font-bungee"
                    >
                        {{ loadingText + "..." }}
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            loading: {
                type: Boolean,
                required: true,
                default: () => false,
            },
            loadingText: {
                type: String,
                default: () => "Loading...",
            },
        },
        data() {
            return {
                loadingImages: [
                    "arceus.gif",
                    "arcanine.gif",
                    "alakazam.gif",
                    "aggron.gif",
                    "ampharos.gif",
                    "articuno.gif",
                    "blaziken.gif",
                    "blastoise.gif",
                    "bulbasaur.gif",
                    "butterfree.gif",
                    "butterfree-gigantamax.gif",
                    "blastoise-gigantamax.gif",
                    "beedrill.gif",
                    "celebi.gif",
                    "cinderace.gif",
                    "charmander.gif",
                    "charizard.gif",
                    "charizard-black.gif",
                    "charizard-gigantamax.gif",
                    "dragonite.gif",
                    "deoxys.gif",
                    "darkrai.gif",
                    "dialga.gif",
                    "eevee.gif",
                    "eevee-gigantamax.gif",
                    "entei.gif",
                    "espeon.gif",
                    "electabuzz.gif",
                    "flareon.gif",
                    "flygon.gif",
                    "feraligatr.gif",
                    "gengar.gif",
                    "greninja.gif",
                    "gyarados.gif",
                    "gengar-gigantamax.gif",
                    "garchomp.gif",
                    "giratina.gif",
                    "gardevoir.gif",
                    "groudon.gif",
                    "houndoom.gif",
                    "ho-oh.gif",
                    "inteleon.gif",
                    "jolteon.gif",
                    "jirachi.gif",
                    "kangaskhan.gif",
                    "kyogre.gif",
                    "lapras.gif",
                    "lapras-gigantamax.gif",
                    "lucario.gif",
                    "luxray.gif",
                    "latias.gif",
                    "latios.gif",
                    "lugia.gif",
                    "machamp.gif",
                    "mimikyu.gif",
                    "meganium.gif",
                    "mew.gif",
                    "mewtwo.gif",
                    "magikarp.gif",
                    "milotic.gif",
                    "moltres.gif",
                    "machamp-gigantamax.gif",
                    "mr.mime.gif",
                    "ninetales.gif",
                    "nidoking.gif",
                    "nidoqueen.gif",
                    "pikachu.gif",
                    "pikachu-gigantamax.gif",
                    "palkia.gif",
                    "pidgeot.gif",
                    "psyduck.gif",
                    "pinsir.gif",
                    "poliwrath.gif",
                    "rayquaza.gif",
                    "rapidash.gif",
                    "rillaboom.gif",
                    "raichu.gif",
                    "raikou.gif",
                    "salamence.gif",
                    "sceptile.gif",
                    "snorlax.gif",
                    "snorlax-gigantamax.gif",
                    "swampert.gif",
                    "slowpoke.gif",
                    "slowbro.gif",
                    "slowking.gif",
                    "squirtle.gif",
                    "scyther.gif",
                    "suicune.gif",
                    "typhlosion.gif",
                    "tyranitar.gif",
                    "umbreon.gif",
                    "vaporeon.gif",
                    "venusaur.gif",
                    "zapdos.gif",
                    "zacian.gif",
                    "zamazenta.gif",
                ],
            };
        },
        computed: {
            loadingImg() {
                const randomImage =
                    this.loadingImages[
                        Math.floor(Math.random() * this.loadingImages.length)
                    ];
                return randomImage;
            },
        },
    };
</script>
