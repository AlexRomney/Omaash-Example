<template>
    <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <!-- How it works heading with video -->
        <div :class="auth && auth.user ? 'pt-6' : 'pt-12'"
            class="grid items-center grid-cols-1 gap-12 lg:pt-24 md:grid-cols-2">
            <div>
                <h2 class="text-3xl">How It Works</h2>
                <p class="mt-3 text-xl">
                    Ready to take your card collection to the next level? Omaash
                    is here to make grading as easy, stress-free, and fun as
                    possible! Follow the guidelines on this page to start your
                    submission. Once your cards are shipped off, I'll handle the
                    rest. Let's go!
                </p>
            </div>

            <div class="aspect-w-16 aspect-h-9">
                <iframe :src="youtubeEmbedUrl" title="Hello" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen />
            </div>
        </div>

        <!-- Steps -->

        <div class="relative py-12 lg:py-24 lg:grid lg:grid-cols-2 lg:gap-12 lg:items-start">
            <!-- Left Half -->
            <div>
                <dl class="space-y-10">
                    <how-it-works-item step="1" title="Pick and package your cards">
                        <template v-slot:description>
                            Pick the cards you want graded and carefully clean
                            them. Place each card into a penny sleeve then into
                            a Card Saver 1 (or equivalent product) and package
                            them safely for shipping. I'd recommend sandwiching
                            your cards between cardboard and bubble wrap to
                            prevent damage.

                            <helper-modal btn-text="Accepted TCG's" class="mt-4">
                                <h4 class="text-2xl">Accepted TCG's</h4>
                                <p class="mt-4">
                                    The only TCG's Omaash is currently accepting
                                    are:
                                <ul role="list" class="mt-6 space-y-2 list-disc list-inside">
                                    <li>Pokemon</li>
                                    <li>Dragon Ball Super</li>
                                    <li>Digimon</li>
                                    <li>Weiss Schwarz</li>
                                    <li>One Piece</li>
                                </ul>
                                </p>
                            </helper-modal>
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="2" title="Fill out the submission form and ship">
                        <template v-slot:description>Login and click the "NEW SUBMISSION" button and complete the
                            form. Print the page after you are done and include
                            it in your package with your cards. Send your cards
                            to:

                            <strong class="block mt-4 text-lg">
                                Alex Romney <br />
                                1021 E Blackfeet Dr. <br />
                                Eagle Mountain, UT 84005.
                            </strong>

                            <helper-modal class="mt-4" btn-text="Info">
                                <h4 class="text-2xl">Lost Packages</h4>
                                <p class="mt-4">
                                    I am not liable for any packages that might get lost
                                    while in transit to myself, the grading company, auction
                                    house or back to you.
                                </p>
                            </helper-modal>
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="3" title="Omaash does his thing">
                        <template v-slot:description>
                            Once the cards have been received they are indexed
                            and added to the submission pile. The send off dates
                            are always the 1st and 16th of each month (or the following weekday). The
                            submission is created the day before send off.
                            Cards that arrive after the cutoff will be
                            pushed to the next round.
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="4" title="Time to pay">
                        <template v-slot:description>
                            After the cards are sent to the grading company
                            you will receive a message from Omaash with your
                            balance owed. You will be asked to pay the full
                            amount with the payment option that's saved in your
                            profile. This balance includes the grading cost, Omaash's
                            fee and the shipping to and back from the grading company.
                        </template>
                    </how-it-works-item>
                </dl>
            </div>

            <!-- Right Half -->
            <div class="mt-10 lg:mt-0">
                <dl class="space-y-10">
                    <how-it-works-item step="5" title="Patiently wait">
                        <template v-slot:description>
                            Omaash has no power over how long the grading
                            companies take to grade your cards. You will be able
                            to check the status of your sub anytime using
                            your unique sub ID provided to you after
                            completing the submission form.
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="6" title="Grading is complete">
                        <template v-slot:description>
                            As soon as Omaash gets the cards back from the
                            grading companies you will either receive a message asking
                            if you would like to add insurance to your package heading home
                            or your cards will be sent off to be auctioned.
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="7" title="Time to Reveal">
                        <template v-slot:description>
                            Omaash will reveal the freshly graded cards live on his YouTube channel
                            for you to view and enjoy.
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="8" title="Auction">
                        <template v-slot:description>
                            If you chose to auction your cards they will be sent to the company
                            you selected and go through their processes of selling.

                            <helper-modal btn-text="Auction Companies" class="mt-4">
                                <h4 class="text-2xl">Auction Companies</h4>
                                <p class="mt-4">
                                    The options for which auctions you can use are:
                                <ul role="list" class="mt-6 space-y-2 list-disc list-inside">
                                    <li>Probstein</li>
                                    <li>ZandG Emporium</li>
                                </ul>
                                </p>
                            </helper-modal>
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="9" title="Job well done">
                        <template v-slot:description>
                            Omaash will either pay you the cash your cards sold for in auction
                            or ship back your freshly graded cards and
                            message you the shipping amount owed and your tracking number.
                            Once the shipping has been paid everything is officially... COMPLETE!
                        </template>
                    </how-it-works-item>
                    <how-it-works-item step="10" title="Rinse. Wash. Repeat. Be happy!">
                        <template v-slot:description>
                            Come back and use the The Omaash Middleman Service
                            again anytime! I'll be ready to help grade and
                            protect your cherished cards whenever you want!
                        </template>
                    </how-it-works-item>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
    import HowItWorksItem from "@/Components/middleman/HowItWorksItem";
    import HelperModal from "@/Components/HelperModal";

    export default {
        components: {
            HowItWorksItem,
            HelperModal,
        },
        props: {
            auth: Object,
        },
        data() {
            return {
                youtubeEmbedUrl: "https://www.youtube.com/embed/-DIs4bSmNzQ"
            };
        },
    };
</script>
