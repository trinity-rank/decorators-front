<?php

namespace Trinityrank\DecoratorsFront\Models;

use App\Articles\Types\Blog;
use App\Categories\Types\MoneyPageCategory;
use App\Categories\Types\ReviewPageCategory;
use App\Models\Operater;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use TOC\MarkupFixer;

class Decorator extends Model
{
    protected static $decoratorMapper = [
        'table-section' => 'parseTableSection',                                     // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal

        'three-column-section' => 'formatThreeColumnSection',                       // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT)
        'title-section' => 'formatTitleSection',                                    // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'image-three-rows-section' => 'formatImageThreeRowsSection',                // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal
        'youtube-section' => 'formatYoutubeSection',                                // FORTUNLY (TF), SBG (TS), RW42 (TR), TechTribunal
        'content-section' => 'formatContentSection',                                // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'faq-section' => 'formatFaqSection',                                        // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'sources-section' => 'formatSourcesSection',                                // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'methodology-section' => 'formatMethodologySection',                        // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'featured-snippet-section' => 'formatFeaturedSnippetSection',               // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'show-more-section' => 'formatShowMoreSection',                             // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'single-review-table-section' => 'formatSingleReviewTableSection',          // FORTUNLY (TF), SBG (TS), RW42 (TR), TechTribunal
        'review-compare-section' => 'formatReviewCompareSection',                   // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal
        'content-table' => 'formatContentTableSection',                             // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal
        'offer-summary-table-section' => 'parseOfferSummaryTableSection',           // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech

        'values-content-two-buttons-table-sections' => 'parseValuesContentTwoButtonsTableSection',  // FORTUNLY (TF), SBG (TS)
        'detailed-blue-table-section' => 'parseDetailedBlueTableSection',           // FORTUNLY (TF), SBG (TS)
        'values-content-table-section' => 'parseValuesContentTableSection',         // FORTUNLY (TF), SBG (TS)
        'values-phone-content-table-section' => 'parseValuesPhoneContentTableSection', // FORTUNLY (TF), SBG (TS)

        'authors-section' => 'authorsSection',                                      // SBG (TS), RW42 (TR), Techjury (TT)
        'related-product-section' => 'formatRelatedProductSection',                 // SBG (TS), RW42 (TR), Techjury (TT)
        'text-banner' => 'formatTextBannerSection',                                 // FORTUNLY (TF) [ONLY]

        'review-score-compare-section' => 'formatReviewScoreCompareSection',        // SBG (TS)
        'text-left-image-right-section' => 'formatTextLeftImageRightSection',       // SBG (TS)
        'divide-by-letters-section' => 'formatDivideByLettersSection',              // SBG (TS)

        'image-and-content-side-by-side-section' => 'imageAndContentSideBySideSection', // RW42 (TR), Techjury (TT)
        'single-review-box-with-rating-section' => 'singleReviewBoxWithRatingSection',  // RW42 (TR)
        'single-review-hardware-box-section' => 'singleReviewHardwareBoxSection',       // RW42 (TR), Techjury (TT)
        'single-review-compare-section' => 'singleReviewCompareSection',                // RW42 (TR), Techjury (TT)
        'small-three-column-table' => 'smallThreeColumnTableSection',                   // RW42 (TR), Techjury (TT)
        'review-grid-section' => 'formatReviewGridSection',                             // RW42 (TR), Techjury (TT)
        'content-with-background-section' => 'formatContentWithBackgroundSection',      // RW42 (TR), Techjury (TT)
        'content-in-quotes-section' => 'formatContentInQuotesSection',                  // RW42 (TR), Techjury (TT)
        'review-pricing-grid-section' => 'formatReviewPricingGridSection',              // RW42 (TR), Techjury (TT)
        'review-strengths-weaknesses-section' => 'formatReviewStrengthsWeaknessesSection', // RW42 (TR), Techjury (TT)
        'pros-cons-table-section' => 'parseProsConsTableSection',                       // RW42 (TR), Techjury (TT)
        'offer-bullets-table-section' => 'parseOfferBulletsTableSection',               // RW42 (TR), Techjury (TT), TechTribunal [ONLY]
        'hardware-box-table-section' => 'parseHardwareBoxTableSection',                 // RW42 (TR), Techjury (TT), KommandoTech [ONLY]

        'disclaimer-section' => 'disclaimerSection',                                    // Techjury (TT)
        'single-review-box-with-features-section' => 'singleReviewBoxWithFeaturesSection',  // Techjury (TT)
        'money-page-grid-section' => 'formatMoneyPageGridSection',                      // Techjury (TT)
        'post-grid-section' => 'formatPostGridSection',                                 // Techjury (TT)
        'background-checks-section' => 'formatBackgroundChecksSection',                 // Techjury (TT)
        'related-review-section' => 'formatRelatedReviewSection',                       // Techjury (TT)

        'standard-data-table-section' => 'parseStandardDataTableSection',               // Dataprot [ONLY]
        'single-review-box-section' => 'formatSingleReviewRowSection',                  // Dataprot, KommandoTech [ONLY]
        'stats-highlight-section' => 'formatStatsHighlightSection',                     // Dataprot, TechTribunal, KommandoTech [ONLY]
        'editors-choice-section' => 'parseEditorsChoiceSection',                        // Dataprot [ONLY]
        'related-posts-section' => 'formatRelatedPostsSection',                         // Dataprot, TechTribunal [ONLY]
        'title-image-text-grid-section' => 'formatTitleImageTextGridSection',           // Dataprot, KommandoTech [ONLY]

        'products-table-section' => 'parseProductTableSection',                         // TechTribunal [ONLY]
        'deals-list-layout' => 'formatDealsListLayout',                                 // TechTribunal [ONLY]
        'home-title-section' => 'formatHomeTitleSection',                               // TechTribunal [ONLY]
        'moneypage-slider-section' => 'formatMoneypageSliderSection',                   // TechTribunal [ONLY]
        'home-mission-section' => 'formatHomeMissionSection',                           // TechTribunal [ONLY]
        'reviews-section' => 'formatReviewsSection',                                    // TechTribunal [ONLY]
        'home-top-posts-section' => 'formatHomeTopPostsSection',                        // TechTribunal [ONLY]
        'single-review-compare-features-section' => 'formatSingleReviewCompareFeaturesSection', // TechTribunal [ONLY]

        'products-compare-section' => 'formatProductsCompareSection',                    // KommandoTech [ONLY]

        // COMPLETED ^^^^


        // DIF
        'grid-section' => 'formatGridSection',                              // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'tech-table-section' => 'parseTechTableSection',                    // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal
        'standard-table-section' => 'parseStandardTableSection',            // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal
        'credit-card-table-section' => 'parseCreditCardTableSection',       // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'three-cards-table-section' => 'parseThreeCardsTableSection',       // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech
        'gambler-table-section' => 'parseGamblerTableSection',              // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal
        'values-bullets-table-section' => 'parseValuesBulletsTableSection', // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot, TechTribunal, KommandoTech

        // DIF NAME

        // 'values-content-table-section' => 'formatValuesContentTableSection', // TechTribunal
        // 'values-phone-content-table-section' => 'formatValuesPhoneContentTableSection', // X2 dif name  TechTribunal
        // 'values-content-two-buttons-table-sections' => 'formatValuesContentTwoButtonsTableSection', // X2 dif name TechTribunal

        // Dataprot problems

//        'three-column-section' => 'formatThreeColumnSection',
//        'single-review-table-section' => 'formatSingleReviewTableSection',
//        'detailed-blue-table-section' => 'parseDetailedBlueTableSection',
//        'values-content-table-section' => 'parseValuesContentTableSection',
//        'content-table' => 'formatContentTableSection',
//        'related-review-section' => 'formatRelatedReviewSection',

        // TechTribunal problems

//      'three-column-section' => 'formatThreeColumnSection',
//      'detailed-blue-table-section' => 'parseDetailedBlueTableSection'
//      'single-review-box-section' => 'formatSingleReviewRowSection',
//      'review-pricing-grid-section' => 'formatReviewPricingGridSection',
//      'review-strengths-weaknesses-section' => 'formatReviewStrengthsWeaknessesSection',
//      'single-review-hardware-box-section' => 'formatSingleReviewHardwareBoxSection',
//      'single-review-compare-section' => 'formatSingleReviewCompareSection',

        // KommandoTech problems

//      'three-column-section' => 'formatThreeColumnSection',
//      'standard-data-table-section' => 'formatStandardDataTableSection',
//      'single-review-table-section' => 'formatSingleReviewTableSection',
//      'review-compare-section' => 'formatReviewCompareSection',
//      'offer-bullets-table-section' => 'parseOfferBulletsTableSection',
//      'values-content-table-section' => 'parseValuesContentTableSection',
//      'content-table' => 'formatContentTableSection',
//      'related-review-section' => 'formatRelatedReviewSection',
//      'editors-choice-section' => 'formatEditorsChoiceSection',  <-- dif name
//      'related-posts-section' => 'formatRelatedPostsSection',
//      'review-pricing-grid-section' => 'formatReviewPricingGridSection',
//      'table-section' => 'parseTableSection',



        // SITES:
        // Fortunly     - CHECK (DONE),
        // SBG          - CHECK (DONE),
        // Review42     - CHECK (DONE),
        // Techjury     - CHECK (DONE),
        // DataProt     - CHECK,
        // TechTribunal - CHECK,
        // KommandoTech - CHECK,

    ];

    public static function parse($decorators)
    {
        return collect($decorators)->map(function ($decorator) {
            if (array_key_exists($decorator['layout'], self::$decoratorMapper)) {
                $method = self::$decoratorMapper[$decorator['layout']];
                return self::$method($decorator);
            }
            return $decorator;
        });
    }

    public static function parseTableSection($decorator)
    {
        $tableTitle = $decorator['attributes']['table_title'] ?? null;
        $tableElements = json_decode($decorator['attributes']['table'][0]['attributes']['operaters']) ?? null;
        isset($tableElements) ? $operaters = Operater::whereIn('id', $tableElements)->with('media')->orderByRaw('FIELD(id,' . implode(",", $tableElements) . ')')->get() : null;

        $data = [
            'layout' => $decorator['attributes']['table'][0]['layout'] ?? null,
            'data' => [
                'table_title' => $tableTitle ?? null,
                'elements' => isset($operaters) ? $operaters->map(function ($operater) {
                    $tableParser = self::$decoratorMapper[$operater['table_type']] ?? null;
                    $operater['image'] = $operater->getFirstMediaUrl('logo') ?? null;
                    $operater = self::{$tableParser}($operater) ?? [];
                    return $operater;
                })->toArray() : null
            ]
        ];
        return $data ?? null;
    }

    public static function formatThreeColumnSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'text' => $decorator['attributes']['text'] ?? null,
                'columns' => isset($decorator['attributes']['columns']) ? collect($decorator['attributes']['columns'])
                    ->map(function ($element) {
                        return $element['attributes'] ?? null;
                    })
                    ->toArray() : null
            ] ?? null,
        ];
    }

    public static function formatTitleSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => $decorator['attributes'] ?? null
        ];
    }

    public static function formatImageThreeRowsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'description' => $decorator['attributes']['description'] ?? null,
                'elements' => isset($decorator['attributes']['rows']) ? collect($decorator['attributes']['rows'])
                    ->map(function ($element) {
                        return $element['attributes'] ?? null;
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatYoutubeSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? null,
                'description' => $decorator['attributes']['description'] ?? null,
                'elements' => isset($decorator['attributes']['youtube']) ? collect($decorator['attributes']['youtube'])
                    ->map(function ($element) {
                        return [
                            'key' => $element['key'] ?? null,
                            'title' => $element['attributes']['title'] ?? null,
                            'description' => $element['attributes']['description'] ?? null,
                            'url' => $element['attributes']['url'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ]  ?? null,
        ];
    }

    public static function formatGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'label_title' => $decorator['attributes']['label_title'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'elements' => isset($decorator['attributes']['grid']) ? collect($decorator['attributes']['grid'])
                    ->map(function ($element) {
                        if(isset($element['attributes'])) {
                            $model = collect($element['attributes'])->keys()->last() ?? null;
                            if($model != null) {
                                $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first() ?? null;
                                $routePrefix = strtolower(collect(explode('\\', $model))->last()) ?? null;
                                if($page != null) {
                                    $category = $page->categories->first() ?? null;
                                }
                            }
                        }
                        return [
                            'title' => $element['attributes']['title'] ?? null,
                            'description' => $element['attributes']['description'] ?? null,
                            'button_text' => $element['attributes']['button_text'] ?? null,
                            'routePrefix' => $routePrefix ?? null,
                            'page' => $page ?? null,
                            'category' => $category ?? null,
                            'category_name' => $category->name ?? null,
                            'category_icon' => isset($category) ? $category->getFirstMediaUrl('icon') : null,
                            'background_color' => $element['attributes']['background_color'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ] ?? null
        ];
    }

    public static function parseStandardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title']?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? $decorator->decorators[0]['attributes']['title'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'on_website' => $decorator->decorators[0]['attributes']['on_website'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'bottom_line' => $decorator->decorators[0]['attributes']['bottom_line'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature'] ?? null,
                ];
            })
                ->toArray() : null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? null,
                    'value' => $element['attributes']['value'] ?? null,
                ];
            })->toArray() : null,
        ];
    }

    public static function formatContentSection($decorator)
    {
        // Fix iframe for responsive
        $content = str_replace("<iframe", "<div class='iframe-wrapper'><iframe", $decorator['attributes']['content'] ?? '');
        $content = str_replace("</iframe>", "</iframe></div>", $content);
        /*
        Lazy Load
        can't replace all "src" to "data-src" because "script" tag also has "src" attribute
        */
        // Iframe
        $content = str_replace('src="https://www.youtube.com', 'data-src="https://www.youtube.com', $content);
        // Img
        $content = str_replace('src="https://trinity-core.s3-us-west-1.amazonaws.com', 'data-src="https://trinity-core.s3-us-west-1.amazonaws.com', $content);

        $content = (new MarkupFixer())->fix($content);
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => $content ?? null
        ];
    }

    public static function formatFaqSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? 'FAQ',
                'elements' => isset($decorator['attributes']['faq']) ? collect($decorator['attributes']['faq'])
                    ->map(function ($element) {
                        return [
                            'question' => $element['attributes']['question'] ?? null,
                            'answer' => $element['attributes']['answer'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ] ?? null
        ];
    }

    public static function formatSourcesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'elements' => isset($decorator['attributes']['sources']) ? collect($decorator['attributes']['sources'])
                    ->map(function ($element) {
                        return [
                            'name' => $element['attributes']['name'] ?? null,
                            'url' => $element['attributes']['url'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ] ?? null
        ];
    }

    public static function formatMethodologySection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'elements' => isset($decorator['attributes']['methodology']) ? collect($decorator['attributes']['methodology'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'] ?? null,
                            'content' => $element['attributes']['content'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ] ?? null
        ];
    }

    public static function formatFeaturedSnippetSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'list_type' => $decorator['attributes']['list_type'] ?? null,
                'bottom_text' => $decorator['attributes']['bottom_text'] ?? null,
                'elements' => isset($decorator['attributes']['featured-snippets']) ? collect($decorator['attributes']['featured-snippets'])
                    ->map(function ($element) {
                        return [
                            'snippet' => $element['attributes']['snippet'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatShowMoreSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => isset($decorator['attributes']['content']) ? (new MarkupFixer())->fix($decorator['attributes']['content']) : null
        ];
    }

    public static function parseCreditCardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'sub_text' => $decorator->decorators[0]['attributes']['sub_text'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? null,
            'credit_score_min' => $decorator->decorators[0]['attributes']['credit_score_min'] ?? null,
            'credit_score_max' => $decorator->decorators[0]['attributes']['credit_score_max'] ?? null,
            'price_title' => $decorator->decorators[0]['attributes']['price_title'] ?? null,
            'price' => $decorator->decorators[0]['attributes']['price'] ?? null,
            'price_text' => $decorator->decorators[0]['attributes']['price_text'] ?? null,
            'website_url' => $decorator->decorators[0]['attributes']['website_url'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'detail_title' => $decorator->decorators[0]['attributes']['detail_title'] ?? null,
            'detail_text' => $decorator->decorators[0]['attributes']['detail_text'] ?? null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['key_features_list-section_feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
            'rates_and_fees' => isset($decorator->decorators[0]['attributes']['rates_and_fees']) ? collect($decorator->decorators[0]['attributes']['rates_and_fees'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? null,
                    'value' => $element['attributes']['value'] ?? null,
                ];
            })->toArray() : null,
        ];
    }

    public static function formatSingleReviewTableSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'] ?? null,
                        'intro_bonus_title' => $element['attributes']['intro_bonus_title'] ?? null,
                        'intro_bonus_price' => $element['attributes']['intro_bonus_price'] ?? null,
                        'intro_bonus_text' => $element['attributes']['intro_bonus_text'] ?? null,
                        'rating' => $element['attributes']['rating'] ?? null,
                        'cta_text' => $element['attributes']['cta_text'] ?? null,
                        'cta_url' => $element['attributes']['cta_url'] ?? null,
                        'inactive' => $element['attributes']['inactive'] ?? false,
                        'main_features' => isset($element['attributes']['main_features']) ? collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'feature_title' => $element['attributes']['feature_title'] ?? null,
                                'feature_text' => $element['attributes']['feature_text'] ?? null
                            ];
                        })->toArray() : null,
                        'strenghts' => isset($element['attributes']['strenghts']) ? collect($element['attributes']['strenghts'])->map(function ($element) {
                            return [
                                'strenght' => $element['attributes']['strenght'] ?? null
                            ];
                        })->toArray() : null,
                        'weaknesses' => isset($element['attributes']['weaknesses']) ? collect($element['attributes']['weaknesses'])->map(function ($element) {
                            return [
                                'weakness' => $element['attributes']['weakness'] ?? null
                            ];
                        })->toArray() : null,
                    ];
                })->toArray() : null
            ] ?? null
        ];
    }

    public static function formatReviewCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'table_title' => $decorator['attributes']['table_title'] ?? null,
                'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'] ?? null,
                        'title' => $element['attributes']['title'] ?? null,
                        'main_features' => isset($element['attributes']['main_features']) ? collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'title' => $element['attributes']['title'] ?? null,
                                'text' => $element['attributes']['text'] ?? null
                            ];
                        })->toArray() : null,
                        'cta_text' => $element['attributes']['cta_text'] ?? null,
                        'cta_url' => $element['attributes']['cta_url'] ?? null
                    ];
                })->toArray() : null
            ] ?? null
        ];
    }

    public static function parseThreeCardsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_lock' => $decorator->decorators[0]['attributes']['cta_lock'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'phone' => $decorator->decorators[0]['attributes']['phone'] ?? null,
            'main_features_table' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_value' => $element['attributes']['feature_value'] ?? null,
                ];
            })->toArray() : null,
            'content_tabs' => isset($decorator->decorators[0]['attributes']['content_tabs']) ? collect($decorator->decorators[0]['attributes']['content_tabs'])->map(function ($element) {
                return [
                    'tab_title' => $element['attributes']['tab_title'] ?? null,
                    'tab_content' => $element['attributes']['tab_content'] ?? null,
                ];
            })->toArray() : null,
            'content_tabs_v2' => isset($decorator->decorators[0]['attributes']['content_tabs_v2']) ? collect($decorator->decorators[0]['attributes']['content_tabs_v2'])->map(function ($element) {
                return [
                    'tab_title' => $element['attributes']['tab_title'] ?? null,
                    'tab_content' => $element['attributes']['tab_content'] ?? null,
                ];
            })->toArray() : null,
        ];
    }

    public static function parseOfferSummaryTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'bottom_line_title' => $decorator->decorators[0]['attributes']['bottom_line_title'] ?? null,
            'bottom_line_text' => $decorator->decorators[0]['attributes']['bottom_line_text'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'special_offer_title' => $decorator->decorators[0]['attributes']['special_offer_title'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'special_offer_text' => $decorator->decorators[0]['attributes']['special_offer_text'] ?? null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function parseTechTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'learn_more_url' => $decorator->decorators[0]['attributes']['learn_more_url'] ?? null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature'] ?? null,
                ];
            })->toArray() : null,
        ];
    }

    public static function parseGamblerTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'name' => $decorator->decorators[0]['attributes']['name'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null,
                    'additional_info' => $element['attributes']['main_features_list_section_aditional_info'] ?? null,
                ];
            })->toArray() : null,
            'bottom_section_features' => isset($decorator->decorators[0]['attributes']['bottom_section_features']) ? collect($decorator->decorators[0]['attributes']['bottom_section_features'] ?? null)->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['bottom_section_features_list-section_feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function parseDetailedBlueTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'short_description' => $decorator->decorators[0]['attributes']['short_description'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'review_text' => $decorator->decorators[0]['attributes']['review_text'] ?? null,
            'learn_more_link' => $decorator->decorators[0]['attributes']['learn_more_link'] ?? null,
            'learn_more_text' => $decorator->decorators[0]['attributes']['learn_more_text'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
            'pros' => isset($decorator->decorators[0]['attributes']['pros']) ? collect($decorator->decorators[0]['attributes']['pros'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['pro'] ?? null
                ];
            })
                ->flatten(1)
                ->toArray() : null,
            'cons' => isset($decorator->decorators[0]['attributes']['cons']) ? collect($decorator->decorators[0]['attributes']['cons'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['con'] ?? null
                ];
            })
                ->flatten(1)
                ->toArray() : null,
        ];
    }

    public static function parseValuesBulletsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'credit_score_min' => $decorator->decorators[0]['attributes']['credit_score_min'] ?? null,
            'credit_score_max' => $decorator->decorators[0]['attributes']['credit_score_max'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'main_features_table' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
            'main_features_bullets' => isset($decorator->decorators[0]['attributes']['main_features_bullets']) ? collect($decorator->decorators[0]['attributes']['main_features_bullets'])->map(function ($element) {
                return [
                    'feature_item' => $element['attributes']['feature_item'] ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function parseValuesContentTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'comperable' => $decorator->decorators[0]['attributes']['comperable'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'main_features_table' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text']  ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function parseValuesPhoneContentTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'phone' => $decorator->decorators[0]['attributes']['phone'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'main_features_table' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function parseValuesContentTwoButtonsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'subtitle' => $decorator->decorators[0]['attributes']['subtitle'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_value' => $element['attributes']['feature_value'] ?? null
                ];
            })->toArray() : null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
        ];
    }

    public static function formatContentTableSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'title_columns' => isset($decorator['attributes']['title_columns']) ? collect($decorator['attributes']['title_columns'])->map(function ($element) {
                        return [
                            $element['attributes']['column_title'] ?? null
                        ];
                    })->flatten(1)->toArray() : null,
                    'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                        return [
                            'table_columns' => isset($element['attributes']['table_columns']) ? collect($element['attributes']['table_columns'])->map(function ($element) {
                                return [
                                    'column_value' => $element['attributes']['column_value'] ?? null,
                                    'column_link' => $element['attributes']['column_link'] ?? null
                                ];
                            })->toArray() : null,
                        ];
                    })->toArray() : null,
                ] ?? null
        ];
    }

    public static function formatTextBannerSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                    'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                    'cta_text' => $decorator['attributes']['cta_text'] ?? null,
                    'cta_url' => $decorator['attributes']['cta_url'] ?? null,
                ] ?? null,
        ];
    }

    public static function formatTextLeftImageRightSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'featured' => $decorator['attributes']['featured'] ?? null,
                    'elements' => isset($decorator['attributes']['rows']) ? collect($decorator['attributes']['rows'])
                        ->map(function ($element) {
                            return $element['attributes'];
                        })
                        ->toArray() : null
                ] ?? null
        ];
    }

    public static function formatReviewScoreCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'table_title' => $decorator['attributes']['table_title'] ?? null,
                    'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                        return [
                            'key' => $element['key'],
                            'title' => $element['attributes']['title'] ?? null,
                            'rating' => $element['attributes']['rating'] ?? null,
                            'review_url' => $element['attributes']['review_url'] ?? null
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function authorsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'users' => isset($decorator['attributes']['authors']) ? User::whereIn('id', json_decode($decorator['attributes']['authors']))->get() ?? null : null,
                    'description' => $decorator['attributes']['description'] ?? null
                ] ?? null
        ];
    }

    public static function formatDivideByLettersSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'main_title' => $decorator['attributes']['main_title'] ?? null,
                    'elements' => isset($decorator['attributes']['paragraph']) ? collect($decorator['attributes']['paragraph'])
                        ->map(function ($element) {
                            $element['attributes']['letter'] = substr($element['attributes']['title'] ?? null , 0, 1);
                            return $element['attributes'];
                        }) : null
                ] ?? null
        ];
    }

    public static function formatRelatedProductSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                    'elements' => isset($decorator['attributes']['related-products']) ? collect($decorator['attributes']['related-products'])
                        ->map(function ($element) {
                            $model = collect($element['attributes'])->keys()->last();
                            return $element['attributes'][$model] ?? null;
                        })->toArray() : null
                ]  ?? null
        ];
    }

    public static function imageAndContentSideBySideSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                    'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                    'description' => $decorator['attributes']['description'] ?? null,
                    'button-text' => $decorator['attributes']['button_text'] ?? null,
                    'button-url' => $decorator['attributes']['button_url'] ?? null,
                    'image-right' => $decorator['attributes']['pull_image_right'] ?? null,
                ] ?? null,
        ];
    }

    public static function singleReviewBoxWithRatingSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'fact_checked' => $decorator['attributes']['fact_checked'] ?? null,
                    'cta_url' => $decorator['attributes']['cta_url'] ?? null,
                    'cta_text' => $decorator['attributes']['cta_text'] ?? null,
                    'price_text' => $decorator['attributes']['price_text'] ?? null,
                    'price' => $decorator['attributes']['price'] ?? null,
                    'main_features' => isset($decorator['attributes']['main_features']) ? collect($decorator['attributes']['main_features'])->map(function ($element) {
                        return [
                            'title' => $element['attributes']['feature_title'] ?? null,
                            'feature_text' => $element['attributes']['feature_text'] ?? null,
                            'rating' => $element['attributes']['rating'] ?? null
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function singleReviewHardwareBoxSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'fact_checked' => $decorator['attributes']['fact_checked'] ?? null,
                    'rating' => $decorator['attributes']['rating'] ?? null,
                    'merchant_list' => isset($decorator['attributes']['merchant_list']) ? collect($decorator['attributes']['merchant_list'])->map(function ($element) {
                        return [
                            'price' => $element['attributes']['price'] ?? null,
                            'cta_url' => $element['attributes']['cta_url'] ?? null,
                            'cta_text' => $element['attributes']['cta_text'] ?? null,
                            'merchant' => $element['attributes']['merchant'] ?? null,
                        ];
                    })->toArray() : null,
                    'main_features' => isset($decorator['attributes']['main_features_table']) ? collect($decorator['attributes']['main_features_table'])->map(function ($element) {
                        return [
                            'title' => $element['attributes']['feature_title'] ?? null,
                            'text' => $element['attributes']['feature_text'] ?? null,
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function singleReviewCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'fact_checked' => $decorator['attributes']['fact_checked'] ?? null,
                    'winner_title' => $decorator['attributes']['winner_title'] ?? null,
                    'winner_rating' => $decorator['attributes']['winner_rating'] ?? null,
                    'winner_cta_text' => $decorator['attributes']['winner_cta_text'] ?? null,
                    'winner_cta_url' => $decorator['attributes']['winner_cta_url'] ?? null,
                    'loser_title' => $decorator['attributes']['loser_title'] ?? null,
                    'loser_rating' => $decorator['attributes']['loser_rating'] ?? null,
                    'loser_cta_text' => $decorator['attributes']['loser_cta_text'] ?? null,
                    'loser_cta_url' => $decorator['attributes']['loser_cta_url'] ?? null,
                    'main_features' => isset($decorator['attributes']['main_features']) ? collect($decorator['attributes']['main_features'])->map(function ($element) {
                        return [
                            'title' => $element['attributes']['feature_title'] ?? null,
                            'winner_text' => $element['attributes']['winner_text'] ?? null,
                            'loser_text' => $element['attributes']['loser_text'] ?? null,
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function smallThreeColumnTableSection($decorator)
    {

        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                    'text' => $decorator['attributes']['text'] ?? null,
                    'table' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                        return [
                            'key' => $element['key'] ?? null,
                            'title' => $element['attributes']['title'] ?? null,
                            'review_url' => $element['attributes']['review_url'] ?? null,
                            'main_features' => isset($element['attributes']['main_features']) ? collect($element['attributes']['main_features'])->map(function ($subelement) {
                                return [
                                    'feature_title' => $subelement['attributes']['feature_title'] ?? null,
                                    'feature_text' => $subelement['attributes']['feature_text'] ?? null,
                                ];
                            })->toArray() : null
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function formatReviewGridSection($decorator)
    {
        $reviews = ReviewPageCategory::orderBy('created_at', 'desc')->limit(9)->with('media')->get() ?? null;
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'reviews' => $reviews ?? null,
                    'label_title' => $decorator['attributes']['label_title'] ?? null,
                    'title' => $decorator['attributes']['title'] ?? null,
                    'review_description' => $decorator['attributes']['review_description'] ?? null
                ] ?? null
        ];
    }

    public static function formatContentWithBackgroundSection($decorator)
    {
        // Fix iframe for responsive
        $content = str_replace("<iframe", "<div class='iframe-wrapper'><iframe", $decorator['attributes']['content'] ?? '');
        $content = str_replace("</iframe>", "</iframe></div>", $content);
        /*
        Lazy Load
        can't replace all "src" to "data-src" because "script" tag also has "src" attribute
        */
        // Iframe
        $content = str_replace('src="https://www.youtube.com', 'data-src="https://www.youtube.com', $content);
        // Img
        $content = str_replace('src="https://trinity-core.s3-us-west-1.amazonaws.com', 'data-src="https://trinity-core.s3-us-west-1.amazonaws.com', $content);

        $content = (new MarkupFixer())->fix($content);
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => $content ?? null
        ];
    }

    public static function formatContentInQuotesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'content' => $decorator['attributes']['content']  ?? null,
                ]  ?? null
        ];
    }

    public static function formatReviewPricingGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'table_row' => isset($decorator['attributes']['table_row']) ? collect($decorator['attributes']['table_row'])->map(function ($element) {
                        return [
                            'url' => $element['attributes']['url'] ?? null,
                            'plan' => $element['attributes']['plan'] ?? null,
                            'offer' => $element['attributes']['offer'] ?? null,
                            'description' => $element['attributes']['description'] ?? null
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function formatReviewStrengthsWeaknessesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'best_for' => $decorator['attributes']['best_for'] ?? null,
                    'strengths' => isset($decorator['attributes']['strengths']) ? collect($decorator['attributes']['strengths'])->map(function ($element) {
                        return [
                            'text' => $element['attributes']['strength'] ?? null,
                        ];
                    })->toArray() : null,
                    'weaknesses' => isset($decorator['attributes']['weaknesses']) ? collect($decorator['attributes']['weaknesses'])->map(function ($element) {
                        return [
                            'text' => $element['attributes']['weakness'] ?? null,
                        ];
                    })->toArray() : null
                ]  ?? null
        ];
    }

    public static function parseProsConsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
            'pros_list' => isset($decorator->decorators[0]['attributes']['pros_list']) ? collect($decorator->decorators[0]['attributes']['pros_list'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['text'] ?? null
                ];
            })
                ->flatten(1)
                ->toArray() : null,
            'cons_list' => isset($decorator->decorators[0]['attributes']['cons_list']) ? collect($decorator->decorators[0]['attributes']['cons_list'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['text'] ?? null,
                ];
            })
                ->flatten(1)
                ->toArray() : null,
        ];
    }

    public static function parseOfferBulletsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'bulleted_features' => isset($decorator->decorators[0]['attributes']['bulleted_features']) ? collect($decorator->decorators[0]['attributes']['bulleted_features'])->map(function ($element) {
                return [
                    'value' => $element['attributes']['value']  ?? null,
                ];
            })->toArray() : null
        ];
    }

    public static function parseHardwareBoxTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'] ?? null,
            'description' => $decorator->decorators[0]['attributes']['description'] ?? null,
            'product_gallery' => $decorator->getMedia('product_gallery_' . $decorator->decorators[0]['key'] ?? '')  ?? null,
            'merchant_list' => isset($decorator->decorators[0]['attributes']['merchant_list']) ? collect($decorator->decorators[0]['attributes']['merchant_list'])->map(function ($element) {
                return [
                    'price' => $element['attributes']['price'] ?? null,
                    'currency' => $element['attributes']['merchant-list_currency'] ?? null,
                    'cta_url' => $element['attributes']['cta_url'] ?? null,
                    'cta_text' => $element['attributes']['cta_text'] ?? null,
                    'merchant' => $element['attributes']['merchant'] ?? null
                ];
            })->toArray() : null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['feature_title'] ?? null,
                    'text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null
        ];
    }

    public static function disclaimerSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'description' => $decorator['attributes']['description'] ?? null
                ] ?? null
        ];
    }

    public static function singleReviewBoxWithFeaturesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'fact_checked' => $decorator['attributes']['fact_checked'] ?? null,
                    'description' => $decorator['attributes']['description'] ?? null,
                    'cta_url' => $decorator['attributes']['cta_url'] ?? null,
                    'cta_text' => $decorator['attributes']['cta_text'] ?? null,
                    'price_text' => $decorator['attributes']['price_text'] ?? null,
                    'price' => $decorator['attributes']['price'] ?? null,
                    'main_features' => isset($decorator['attributes']['main_features']) ? collect($decorator['attributes']['main_features'])->map(function ($element) {
                        return [
                            'title' => $element['attributes']['feature_title'] ?? null,
                            'feature' => $element['attributes']['feature_text'] ?? null
                        ];
                    })->toArray() : null,
                    'works_on' => $decorator['attributes']['works_on'] ?? null,
                ] ?? null
        ];
    }

    public static function formatMoneyPageGridSection($decorator)
    {
        $moneypage_categories = MoneyPageCategory::orderBy('created_at', 'desc')->whereNotNull('parent_id')->distinct()->limit(16)->get();
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'moneypage_categories' => $moneypage_categories ?? null,
                    'label_title' => $decorator['attributes']['label_title'] ?? null,
                    'title' => $decorator['attributes']['title'] ?? null,
                    'money_description' => $decorator['attributes']['review_description'] ?? null
                ] ?? null
        ];
    }

    public static function formatPostGridSection($decorator)
    {
        $posts = Blog::whereHas('categories', function ($q) use ($decorator) {
            $q->where('slug', $decorator['attributes']['category']);
        })
            ->orderBy('updated_at', 'desc')
            ->with('media', 'user')
            ->status()
            ->publishDate()
            ->take(8)
            ->get();
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'posts' => $posts ?? null,
                    'category' => $decorator['attributes']['category'] ?? null,
                    'title' => $decorator['attributes']['title'] ?? null,
                    'description' => $decorator['attributes']['description'] ?? null
                ] ?? null
        ];
    }

    public static function formatBackgroundChecksSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                ] ?? null
        ];
    }

    public static function formatRelatedReviewSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'title' => $decorator['attributes']['title'] ?? null,
                    'elements' => isset($decorator['attributes']['related-reviews']) ? collect($decorator['attributes']['related-reviews'])
                        ->map(function ($element) {
                            $model = isset($element['attributes']) ? collect($element['attributes'])->keys()->last() : null;
                            return $element['attributes'][$model] ?? null;
                        })->toArray() : null
                ] ?? null
        ];
    }

    public static function parseStandardDataTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'badge_text' => isset($decorator->decorators[0]['attributes']['badge_text']) ? $decorator->decorators[0]['attributes']['badge_text'] : null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'],
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'],
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'],
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'],
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? 'Apply now',
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'bottom_line' => $decorator->decorators[0]['attributes']['bottom_line'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature']
                ];
            })
                ->flatten(1)
                ->toArray(),
            'applications' => collect($decorator->decorators[0]['attributes']['application'])->map(function ($element, $key) {
                return [
                    $element,
                ];
            })->toArray(),
        ];
    }

    public static function formatSingleReviewRowSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'description' => $element['attributes']['description'],
                        'price_text' => $element['attributes']['price_text'],
                        'price' => $element['attributes']['price'],
                        'price_period' => $element['attributes']['price_period'],
                        'cta_text' => !empty($element['attributes']['cta_text']) ? $element['attributes']['cta_text'] : 'Visit Website',
                        'cta_url' => $element['attributes']['cta_url'],
                        'best_for_title' => $element['attributes']['best_for_title'] ?? null,
                        'best_for_text' => $element['attributes']['best_for_text'] ?? null,
                        'main_features' => collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'feature_title' => $element['attributes']['feature_title'],
                                'feature_text' => $element['attributes']['feature_text']
                            ];
                        })->toArray(),
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatStatsHighlightSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'content' => $decorator['attributes']['content'],
                'list_type' => $decorator['attributes']['list_type'],
                'elements' => collect($decorator['attributes']['stats-highlights'])
                    ->map(function ($element) {
                        return [
                            'stat' => $element['attributes']['stat'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function parseEditorsChoiceSection($decorator)
    {
        return [
            'id' => $decorator['id'],
            'table_type' => $decorator['table_type'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",

            'title' => $decorator->decorators[0]['attributes']['title'],
            'price' => $decorator->decorators[0]['attributes']['price'],
            'price_period' => $decorator->decorators[0]['attributes']['price_period'] ?? 'monthly',
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] !== '' ? $decorator->decorators[0]['attributes']['cta_text'] : 'Visit Website',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'review_url' => isset($decorator->decorators[0]['attributes']['review_url']) ? $decorator->decorators[0]['attributes']['review_url'] : null,
        ];
    }

    public static function formatRelatedPostsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['grid'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first();
                        $routePrefix = strtolower(collect(explode('\\', $model))->last());

                        $category = $page->categories->first();

                        $url = '';
                        $categoryUrl = '';

                        if($routePrefix === 'blog' || $routePrefix === 'moneypage') {
                            $url = route('resolve.single', [$category->slug, $page->slug]);
                            $categoryUrl = route('resolve', [$category->slug]);
                        }

                        if($routePrefix === 'news') {
                            $url = route('news.single', [$category->slug, $page->slug]);
                            $categoryUrl = route('news.category', [$category->slug]);
                        }

                        if($routePrefix === 'reviews') {
                            $url = route('reviews.single', [$category->slug, $page->slug]);
                            $categoryUrl = route('reviews.category', [$category->slug]);
                        }



                        return [
                            'title' => $page['title'],
                            'created_at_m' => $page['created_at']->format('M') ,
                            'created_at_d' => $page['created_at']->format('d'),
                            'url' => $url,
                            'category_name' => $category->name,
                            'image' => $page->getFirstMediaUrl('feature'),
                            'category_url' => $categoryUrl,
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatTitleImageTextGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'key' => $decorator['key'],
                'title' => $decorator['attributes']['title'] ?? null,
                'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                'elements' => collect($decorator['attributes']['columns'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'],
                            'text' => $element['attributes']['text'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function parseProductTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'brand' => $decorator->decorators[0]['attributes']['brand'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Buy Now',
            'content' => $decorator->decorators[0]['attributes']['content'],
            'product_gallery' => $decorator->getMedia('product_gallery_'. $decorator->decorators[0]['key']),
            'main_features_table' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
            'merchant_list' => collect($decorator->decorators[0]['attributes']['merchant_list'])->map(function ($element) {
                return [
                    'merchant' => $element['attributes']['merchant'],
                    'price' => $element['attributes']['price'],
                    'cta_text' => $element['attributes']['cta_text'],
                    'cta_url' => $element['attributes']['cta_url'],
                ];
            })->toArray(),

        ];
    }

    public static function formatDealsListLayout($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'brand' => $element['attributes']['brand'],
                        'title' => $element['attributes']['title'],
                        'website_url' => $element['attributes']['website_url'] ?? null,
                        'bonus_code' => $element['attributes']['bonus_code'],
                        'description' => $element['attributes']['description'],
                        'button_txt' => $element['attributes']['button_txt'],
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatHomeTitleSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => $decorator['attributes']
        ];
    }

    public static function formatReviewsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => $decorator['attributes']
        ];
    }

    public static function formatMoneypageSliderSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'title_text' => $decorator['attributes']['title_text'],
                'elements' => collect($decorator['attributes']['slider'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first();
                        $routePrefix = strtolower(collect(explode('\\', $model))->last());
                        $category = $page->categories->first();
                        $url = '';
                        $categoryUrl = '';
                        $url = route('resolve.single', [$category->slug, $page->slug]);
                        $categoryUrl = route('resolve', [$category->slug]);
                        return [
                            'title' => $page->title,
                            'created_at_d' => $page->created_at->format('d'),
                            'created_at_m' => $page->created_at->format('M'),
                            'url' => $url,
                            'category_name' => $category->name,
                            'image' => $page->getFirstMediaUrl('feature'),
                            'category_url' => $categoryUrl,
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatHomeMissionSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'content' => $decorator['attributes']['content'],
                'elements' => collect($decorator['attributes']['columns'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'],
                            'description' => $element['attributes']['description'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatHomeTopPostsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['slider'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        $page = $model::whereId($element['attributes'][$model])->with('categories', 'media')->first();
                        $routePrefix = strtolower(collect(explode('\\', $model))->last());
                        // ray($page);
                        $category = $page->categories->first();

                        $url = '';
                        $categoryUrl = '';
                        $url = route('resolve.single', [$category->slug, $page->slug]);
                        $categoryUrl = route('resolve', [$category->slug]);
                        return [
                            'title' => $page->title,
                            'url' => $url,
                            'category_name' => $category->name,
                            'image' => $page->getFirstMediaUrl('feature'),
                            'category_url' => $categoryUrl,
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatSingleReviewCompareFeaturesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'winner_best_for' => $decorator['attributes']['winner_best_for'],
                'winner_title' => $decorator['attributes']['winner_title'],
                'loser_best_for' => $decorator['attributes']['loser_best_for'],
                'loser_title' => $decorator['attributes']['loser_title'],
                'main_features' => collect($decorator['attributes']['main_features'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'],
                        'winner_features' => $element['attributes']['winner_features'],
                        'loser_features' => $element['attributes']['loser_features']
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatProductsCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'table_title' => $decorator['attributes']['table_title'],
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'title' => $element['attributes']['title'],
                        'rating' => $element['attributes']['rating'],
                        'brand' => $element['attributes']['brand'],
                        'main_features' => collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'title' => $element['attributes']['title'],
                                'text' => $element['attributes']['text']
                            ];
                        })->toArray(),
                        'key_features' => collect($element['attributes']['key_features'])->map(function ($element) {
                            return [
                                'feature' => $element['attributes']['feature']
                            ];
                        })->flatten(1)
                            ->toArray(),
                        'cta_text' => !empty($element['attributes']['cta_text']) ? $element['attributes']['cta_text'] : '',
                        'cta_url' => !empty($element['attributes']['cta_url']) ? $element['attributes']['cta_url'] : '',
                    ];
                })->toArray()
            ]
        ];
    }

}
