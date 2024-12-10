<template>
    <breeze-layout bg-class="bg-faq" header-size="small">
        <template #header>
            <h2 class="text-4xl text-left text-white">
                Frequently Asked Questions
            </h2>
        </template>

        <section class="py-12 sm:py-24">
            <div class="max-w-4xl px-4 mx-auto space-y-6 sm:px-6 lg:px-8">
                <faq-item question="Why use a middleman?" :show-initially="true">
                    <h3>
                        There are several good reasons for using a middleman.
                        Here are a few of my favorites:
                    </h3>
                    <ul role="list" class="mt-6 ml-6 space-y-2 list-disc list-outside">
                        <li>
                            Little to no hassle for you. All you worry
                            about is picking the cards you want graded,
                            preparing them and sending them my way. That's it!
                        </li>
                        <li>
                            A lot of companies require having a membership in
                            order to grade. The middleman saves you from needing
                            to pay for that membership.
                        </li>
                        <li>
                            Submitting cards is time consuming and can be tricky
                            at times. There is a lot of room for error in finding
                            the right label and ensuring your cards are packaged
                            correctly. With a middleman, I take care of the hard
                            stuff, and you don't need to deal with the hassle!
                        </li>
                        <li>
                            Shipping gets expensive fast when it comes to
                            grading. For most grading services, insurance fees
                            are required to protect the value of your cards.
                            With a middleman, shipping costs are divided by
                            everyone in the submission, so you could save
                            a big chunk of money.
                        </li>
                        <li>
                            It is extremely fun and satisfying to see your
                            freshly graded cards revealed on YouTube!
                        </li>
                    </ul>
                </faq-item>
                <faq-item question="What grading companies do you grade with?">
                    I submit to the big three:
                    <ul role="list" class="my-6 ml-6 space-y-2 list-disc list-outside">
                        <li>PSA</li>
                        <li>BGS</li>
                        <li>CGC</li>
                    </ul>
                    If you want to submit to another company feel free to message me and I'll see if we can do it!
                </faq-item>
                <faq-item question="What do the different submission statuses mean?">
                    There are a total of six grading statuses each submission will go through. They are as follows:
                    <ul role="list" class="my-6 ml-6 space-y-2 list-disc list-outside">
                        <li><strong>Created</strong> - Your submission has been created and Omaash is waiting for the
                            cards to arrive.</li>
                        <li><strong>Received</strong> - Your submission has been received by Omaash, inputted into his
                            system and awaiting send-off.</li>
                        <li><strong>Grading</strong> - The submission has been sent and received by the grading company.
                        </li>
                        <li><strong>Grading Complete</strong> - The grading company has finished all their work and
                            Omaash has the graded cards back ready to reveal.</li>
                        <li><strong>Being Auctioned</strong> - Your cards have been sent off and received by the auction
                            company you selected.</li>
                        <li><strong>Shipped</strong> - Your graded cards have been shipped back to you.</li>
                        <li><strong>Complete</strong> - Once the graded cards have been marked as delivered or I have sent
                            you the funds from the auction the submission is complete.</li>
                    </ul>
                </faq-item>
                <faq-item question="How long does grading take?">
                    This solely depends on which company and grading service you
                    want to pay for. The more expensive services mean you will
                    get your cards back faster while the cheaper tiers can take
                    anywhere from 2-4 months.
                </faq-item>
                <faq-item question="What grading company should I grade my cards with?">
                    One of the best parts about collecting is that there is no right or wrong way. You get to choose
                    what you want to collect and how you want to do so. I am just the middleman doing the submitting
                    of the cards. You need to do the research on which grading company you prefer and choose which
                    company
                    you will want to have your cards encased with before sending them my way.
                </faq-item>
                <faq-item question="How do you keep track of everyone's cards especially when there are duplicates?">
                    Grading companies grade in the order you submit the cards.
                    As soon as I get new cards in the mail, I input them into my
                    Excel sheet to keep everything organized. With every
                    submission, I make sure to submit the cards in the exact order
                    they were received. Because everything is done in numerical
                    order, it's relatively easy to keep track of it all.
                </faq-item>
                <faq-item question="How much will shipping cost?">
                    There are a number of factors that affect the shipping cost
                    of a submission, which makes it really difficult to
                    estimate. Some factors include: how many cards are submitted,
                    the value of the cards, and how many people are involved.
                    Once your cards are submitted, I'll divide the shipping
                    total among everyone in the submission and send you your
                    total to complete your payment!

                </faq-item>
                <faq-item question="How should I package my cards to ship to you?">
                    At the end of the day you can package your cards however you would like, but I am all about
                    protection and keeping cards safe while being shipped. I would recommend sandwiching your cards
                    inbetween two pieces of cardboard, securing them together with rubber bands, and wrap it with a
                    ton bubble-wrap. I would then put that swaddle of bubble-wrap into a box for shipping.
                </faq-item>
                <faq-item question="Why don't you grade sports cards, Magic the Gathering, Yugioh, etc?">
                    I only grade the cards I personally collect because they're
                    the cards I know the best. It takes a lot of time and
                    knowledge to find the correct label and info for a card
                    to be submitted. Since I don't know the ins and outs
                    of the other TCG's I choose to avoid them.
                </faq-item>
                <faq-item question="Do my cards need to be revealed on YouTube?">
                    No they do not, but I can confidently say after a couple
                    years of doing this that most people love that aspect of the
                    service. If you'd prefer not to have your cards revealed
                    on the channel, just let me know and I'll keep them private.
                </faq-item>
                <faq-item question="Do you sell people's cards?">
                    I don't personally offer any consignment services, but you have 
                    the option to have your freshly graded cards sent off for auction
                    at the company of your choosing.
                </faq-item>
                <faq-item question="How long have you been a middleman?">
                    I started my middleman service for my supporters back in
                    July 2020. It's been the best helping everyone grade their
                    most cherished cards!
                </faq-item>
                <faq-item question="Can I ship in toploaders?">
                    Yes, you can ship to me however you would like, but the
                    companies I use require Card Saver 1's or similar product.
                    Because of this, I will need to put your cards into Card
                    Savers before sending. I charge $0.25 per Card Saver for
                    10 cards and under and $0.50 for anything over 10.
                </faq-item>
                <faq-item question="Why do you middleman?">
                    When I first started I simply wanted a way to give back to
                    my supporters of the channel. Since then I have found that
                    there is nothing better than helping others enhance their
                    collecitons by protecting their cards forever. There is no
                    greater feeling than sending in a beloved card and seeing it
                    encased with a grade! I absolutely love it and I can't wait
                    to help many more Omaash Nation members get it done!
                </faq-item>
            </div>
        </section>
    </breeze-layout>
</template>

<script>
    import BreezeLayout from "@/Layouts/Layout";
    import FaqItem from "@/Components/Faq/FaqItem";

    export default {
        components: {
            BreezeLayout,
            FaqItem,
        },
    };
</script>
