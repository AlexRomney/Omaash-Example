<template>
    <div class="py-12 sm:py-24 bg-lightGray">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="sm:flex sm:flex-col sm:align-center">
                <h2 class="text-3xl sm:text-center">Pricing</h2>
                <p class="mt-3 text-xl sm:text-center sm:max-w-xl sm:mx-auto">
                    Current prices and fee breakdown for the grading companies
                    you can submit with.
                </p>
            </div>
            <div
                class="gap-12 mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-12 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-3">
                <pricing-item v-for="(item, propertyName, index) in filteredPrices" :item="item"
                    :property-name="propertyName" :key="index" />
            </div>
            <div class="mt-6 shadow-lg bg-medGray sm:mt-12 sm:space-y-0 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0">
                <div class="w-full px-6 py-8 lg:p-12">
                    <div class="flex items-center">
                        <h4 class="flex-shrink-0 pr-4 text-2xl sm:text-3xl text-lightBlue">
                            Auctions
                        </h4>
                        <div class="flex-1 border-t-2 border-darkGray"></div>
                    </div>
                    <div
                        class="gap-12 mt-6 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-12 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-2">
                        <auction-item v-for="(company, companyName, index) in auctionCompanies" :key="index"
                            :company="company" :companyName="companyName" />
                    </div>
                    <p class="mt-4">
                        You can choose to have your newly graded cards sent off for auction immediately.
                        Omaash will reveal the card grades live on YouTube and will send them to the company you selected.
                        From there we will have to abide by the company's rules and processes
                        and you will get paid when all of your items officially sell.
                    </p>
                </div>
            </div>
            <div class="mt-6 shadow-lg bg-medGray sm:mt-12 sm:space-y-0 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0">
                <div class="w-full px-6 py-8 lg:p-12">
                    <div class="flex items-center">
                        <h4 class="flex-shrink-0 pr-4 text-2xl sm:text-3xl text-lightBlue">
                            My Fee per Card - $1
                        </h4>
                        <div class="flex-1 border-t-2 border-darkGray"></div>
                    </div>
                    <div class="flex items-center mt-4">
                        <h4 class="flex-shrink-0 pr-4 text-2xl sm:text-3xl text-lightBlue">
                            My Auction Fee - 1%
                        </h4>
                        <div class="flex-1 border-t-2 border-darkGray"></div>
                    </div>
                    <p class="p-4 mt-2 bg-lightGray">
                        * The auction fee is 1% of the total amount returned to me minus shipping costs.
                        Not 1% of the total sold amount.
                    </p>
                    <p class="p-4 mt-8 bg-lightGray">
                        * If you need Card Savers they are $0.25 each for 10
                        cards and under. Anything more than 10 cards is
                        $0.50 each.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PricingItem from "@/Components/middleman/PricingItem";
    import AuctionItem from "@/Components/middleman/AuctionItem";
    import BreezeButton from "@/Components/Button";

    export default {
        props: {
            prices: {
                type: Object,
                required: true,
            },
            auctionCompanies: {
                type: Object,
                required: true
            }
        },
        components: {
            PricingItem,
            BreezeButton,
            AuctionItem,
        },
        data() {
            return {
                myFee: null,
            };
        },
        computed: {
            filteredPrices() {
                let newPrices = this.prices;
                this.myFee = this.prices["My Fee"];
                delete newPrices["My Fee"];
                return newPrices;
            },
        },
    };
</script>
