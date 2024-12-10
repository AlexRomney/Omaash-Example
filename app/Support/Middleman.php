<?php

namespace App\Support;

class Middleman
{
    public static function gradingPrices()
    {
        $psa = self::companyPrices('PSA');
        $bgs = self::companyPrices('BGS');
        $cgc = self::companyPrices('CGC');
        $myFee = 1;

        return [
            'PSA' => [
                'url' => 'https://www.psacard.com/pricing',
                'prices' => $psa
            ],
            'BGS' => [
                'url' => 'https://www.beckett.com/grading/',
                'prices' => $bgs
            ],
            'CGC' => [
                'url' => 'https://www.cgccomics.com/submit/services-fees/cgc-grading/?view=trading-cards',
                'prices' => $cgc,
            ], 
            'My Fee' => $myFee
        ];
    }

    public static function companyPrices($company)
    {
        switch ($company) {

            case 'PSA':

                $services = [
                    'bulk' => 14.99,
                    'value bulk' => 18.99,
                    'value' => 24.99,
                    'value plus' => 39.99,
                    'regular' => 74.99,
                    'express' => 129,
                    'super express' => 249
                ];
                break;

            case 'BGS':

                $services = [
                    'base w/o subgrades' => 14.95,
                    'base w/subgrades' => 17.95,
                    'standard w/subgrades' => 34.95,
                    'express w/subgrades' => 79.95,
                    'priority w/subgrades' => 124.95
                ];
                break;

            case 'CGC':

                $services = [
                    'bulk' => 10,
                    'economy' => 13,
                    'standard' => 30,
                    'express' => 50,
                    'walkthrough' => 150
                ];
                break;
        }

        return $services;
    }

    public static function gradingFees($company, $serviceLevel, $numberOfCards, $needsCardSavers, $expedited)
    {
        $myFee = 1;

        switch ($company) {

            case 'PSA':

                switch ($serviceLevel) {

                    case 'bulk': 
                        $pricePerCard = 14.99;
                    break;

                    case 'value bulk': 
                        $pricePerCard = 18.99;
                    break;

                    case 'value': 
                        $pricePerCard = 24.99;
                    break;

                    case 'value plus':
                        $pricePerCard = 39.99;
                    break;

                    case 'regular':
                        $pricePerCard = 74.99;
                    break;

                    case 'express':
                        $pricePerCard = 129;
                        break;

                    case 'super express':
                        $pricePerCard = 249;
                        break;
                }
            break;

            case 'BGS':

                switch ($serviceLevel) {

                    case 'base w/o subgrades': 
                        $pricePerCard = 14.95;
                    break;

                    case 'base w/subgrades':
                        $pricePerCard = 17.95;
                    break;

                    case 'standard w/subgrades':
                        $pricePerCard = 34.95;
                    break;

                    case 'express w subgrades':
                        $pricePerCard = 79.95;
                    break;

                    case 'priority w/subgrades':
                        $pricePerCard = 124.95;
                    break;
                }
            break;

            case 'CGC':

                switch ($serviceLevel) {

                    case 'bulk':
                        $pricePerCard = 10;
                        break;

                    case 'economy':
                        $pricePerCard = 13;
                        break;

                    case 'standard':
                        $pricePerCard = 30;
                        break;

                    case 'express':
                        $pricePerCard = 50;
                        break;

                    case 'walkthrough':
                        $pricePerCard = 150;
                        break;
                }

            break;
        }

        $cardSaverFee = 0;

        if ($needsCardSavers) {
            $cardSaverFeeAmount = $numberOfCards > 10 ? 0.50 : 0.25;
            $cardSaverFee = $numberOfCards * $cardSaverFeeAmount;
        }

        $expeditedFee = $expedited ? 25 : 0;
        $gradingFee = $pricePerCard * $numberOfCards;
        $myFee = ($myFee * $numberOfCards) + $expeditedFee;
        $total = ($gradingFee + $myFee + $cardSaverFee);

        return [
            'gradingFee' => $gradingFee,
            'myFee' => $myFee,
            'cardSaverFee' => $cardSaverFee,
            'total' => $total
        ];
    }
}
