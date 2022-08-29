<?php

namespace Trinityrank\DecoratorsFront\Models;

use App\Articles\Types\Blog;
use App\Categories\Types\MoneyPageCategory;
use App\Categories\Types\ReviewPageCategory;
use App\Models\Operater;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use TOC\MarkupFixer;
use Trinityrank\GeoLocation\GeoLocationOperater;

class Decorator extends Model
{
    protected static $decoratorMapper = [

        'authors-section' => 'authorsSection',                                                          // SBG (TS), RW42 (TR), Techjury (TT)
        'background-checks-section' => 'formatBackgroundChecksSection',                                 // Techjury (TT)
        'contact-page' => 'formatContactPageSection', 
        'content-in-quotes-section' => 'formatContentInQuotesSection',                                  // RW42 (TR), Techjury (TT)
        'content-section' => 'formatContentSection',                                                    // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'content-table' => 'formatContentTableSection',                                                 // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'content-with-background-section' => 'formatContentWithBackgroundSection',                      // RW42 (TR), Techjury (TT)
        'credit-card-table-section' => 'formatCreditCardTableSection',                                  // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'deals-list-layout' => 'formatDealsListLayout',                                                 // TechTribunal (TH)
        'detailed-blue-table-section' => 'formatDetailedBlueTableSection',                              // FORTUNLY (TF), SBG (TS), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'disclaimer-section' => 'disclaimerSection',                                                    // Techjury (TT)
        'divide-by-letters-section' => 'formatDivideByLettersSection',                                  // SBG (TS)
        'editors-choice-section' => 'formatEditorsChoiceSection',                                       // Dataprot (TD), TechTribunal (TH)
        'faq-section' => 'formatFaqSection',                                                            // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'featured-snippet-section' => 'formatFeaturedSnippetSection',                                   // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'gambler-table-section' => 'formatGamblerTableSection',                                         // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal (TH)
        'grid-section' => 'formatGridSection',                                                          // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'hardware-box-table-section' => 'formatHardwareBoxTableSection',                                // RW42 (TR), Techjury (TT), KommandoTech (TK)
        'home-title-section' => 'formatHomeTitleSection',                                               // TechTribunal (TH)
        'home-top-posts-section' => 'formatHomeTopPostsSection',                                        // TechTribunal (TH)
        'image-and-content-side-by-side-section' => 'imageAndContentSideBySideSection',                 // RW42 (TR), Techjury (TT), TechTribunal (TH)
        'image-three-rows-section' => 'formatImageThreeRowsSection',                                    // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal (TH ?)
        'methodology-section' => 'formatMethodologySection',                                            // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'money-page-grid-section' => 'formatMoneyPageGridSection',                                      // Techjury (TT)
        'moneypage-slider-section' => 'formatMoneyPageSliderSection',                                   // TechTribunal (TH)
        'offer-bullets-table-section' => 'formatOfferBulletsTableSection',                              // RW42 (TR), Techjury (TT), TechTribunal (TH), KommandoTech (TK)
        'offer-summary-table-section' => 'formatOfferSummaryTableSection',                              // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'post-grid-section' => 'formatPostGridSection',                                                 // Techjury (TT)
        'products-compare-table-section' => 'formatProductsCompareSection',                             // KommandoTech (TK)
        'products-table-section' => 'formatProductTableSection',                                        // TechTribunal (TH)
        'pros-cons-table-section' => 'formatProsConsTableSection',                                      // RW42 (TR), Techjury (TT)
        'related-posts-section' => 'formatRelatedPostsSection',                                         // Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'related-product-section' => 'formatRelatedProductSection',                                     // SBG (TS), RW42 (TR), Techjury (TT)
        'related-review-section' => 'formatRelatedReviewSection',                                       // Techjury (TT), Dataprot (TD), KommandoTech (TK)
        'review-compare-section' => 'formatReviewCompareSection',                                       // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'review-grid-section' => 'formatReviewGridSection',                                             // RW42 (TR), Techjury (TT)
        'review-pricing-grid-section' => 'formatReviewPricingGridSection',                              // RW42 (TR), Techjury (TT), TechTribunal (TH), KommandoTech (TK)
        'review-score-compare-section' => 'formatReviewScoreCompareSection',                            // SBG (TS)
        'review-strengths-weaknesses-section' => 'formatReviewStrengthsWeaknessesSection',              // RW42 (TR), Techjury (TT), TechTribunal (TH)
        'reviews-section' => 'formatReviewsSection',                                                    // TechTribunal (TH)
        'show-more-section' => 'formatShowMoreSection',                                                 // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'single-review-box-section' => 'formatSingleReviewRowSection',                                  // TechTribunal (TH)
        'single-review-box-with-features-section' => 'singleReviewBoxWithFeaturesSection',              // Techjury (TT)
        'single-review-box-with-rating-section' => 'singleReviewBoxWithRatingSection',                  // RW42 (TR)
        'single-review-compare-features-section' => 'formatSingleReviewCompareFeaturesSection',         // TechTribunal (TH)
        'single-review-compare-section' => 'singleReviewCompareSection',                                // RW42 (TR), Techjury (TT), TechTribunal (TH)
        'single-review-hardware-box-section' => 'singleReviewHardwareBoxSection',                       // RW42 (TR), Techjury (TT), TechTribunal (TH)
        'single-review-table-section' => 'formatSingleReviewTableSection',                              // FORTUNLY (TF), SBG (TS), RW42 (TR), Dataprot (TD), KommandoTech (TK)
        'small-three-column-table' => 'smallThreeColumnTableSection',                                   // RW42 (TR), Techjury (TT)
        'sources-section' => 'formatSourcesSection',                                                    // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'standard-data-table-section' => 'formatStandardDataTableSection',                              // KommandoTech (TK)
        'standard-table-section' => 'formatStandardTableSection',                                       // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal (TH), KommandoTech (TK)
        'stats-highlight-section' => 'formatStatsHighlightSection',                                     // Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'table-section' => 'formatTableSection',                                                         // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'tech-table-section' => 'formatTechTableSection',                                               // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), TechTribunal (TH)
        'text-banner' => 'formatTextBannerSection',                                                     // FORTUNLY (TF)
        'text-left-image-right-section' => 'formatTextLeftImageRightSection',                           // SBG (TS)
        'three-cards-table-section' => 'formatThreeCardsTableSection',                                  // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'three-column-section' => 'formatThreeColumnSection',                                           // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'title-image-text-grid-section' => 'formatTitleImageTextGridSection',                           // Dataprot (TD)
        'title-section' => 'formatTitleSection',                                                        // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'values-bullets-table-section' => 'formatValuesBulletsTableSection',                            // FORTUNLY (TF), SBG (TS), RW42 (TR), Techjury (TT), Dataprot (TD), TechTribunal (TH), KommandoTech (TK)
        'values-content-table-section' => 'formatValuesContentTableSection',                            // FORTUNLY (TF), SBG (TS), Dataprot (TD), KommandoTech (TK)
        'values-content-two-buttons-table-sections' => 'formatValuesContentTwoButtonsTableSection',     // FORTUNLY (TF), SBG (TS)
        'values-phone-content-table-section' => 'formatValuesPhoneContentTableSection',                 // FORTUNLY (TF), SBG (TS)
        'youtube-section' => 'formatYoutubeSection',                                                    // FORTUNLY (TF), SBG (TS), RW42 (TR), TechTribunal (TH)
        'notable-posts-section' => 'formatNotablePostsSection',                                         // DATAPROT

        // in use ????

        // 'values-content-table-section' => 'formatValuesContentTableSection',                         // TechTribunal ?
        // 'values-phone-content-table-section' => 'formatValuesPhoneContentTableSection',              //  TechTribunal ?
        // 'values-content-two-buttons-table-sections' => 'formatValuesContentTwoButtonsTableSection',  // TechTribunal ?
        // 'home-mission-section' => 'formatHomeMissionSection',                                        // TechTribunal ? KommandoTech ?

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

    public static function formatTableSection($decorator)
    {
        $tableTitle = $decorator['attributes']['table_title'] ?? null;
        $operaters_id = json_decode($decorator['attributes']['table'][0]['attributes']['operaters']) ?? null;

        // Geolocation support
        if (class_exists(GeoLocationOperater::class)) {
            $operaters_id = GeoLocationOperater::list($operaters_id);
        }

        isset($operaters_id) ? $operaters = Operater::whereIn('id', $operaters_id)->with('media')->orderByRaw('FIELD(id,' . implode(",", $operaters_id) . ')')->get() : null;

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
                            if (isset($element['attributes'])) {
                                $model = collect($element['attributes'])->keys()->last() ?? null;
                                if ($model != null) {
                                    $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first() ?? null;
                                    $routePrefix = strtolower(collect(explode('\\', $model))->last()) ?? null;
                                    if ($page != null) {
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

    public static function formatStandardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title']?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'show_form' => $decorator->show_form ?? false,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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
        $content = str_replace('src="https://' . env('AWS_BUCKET', 'trinity-core') . '.s3.' . env('AWS_DEFAULT_REGION', 'us-west-1') . '.amazonaws.com', 'data-src="https://' . env('AWS_BUCKET', 'trinity-core') . '.s3.' . env('AWS_DEFAULT_REGION', 'us-west-1') . '.amazonaws.com', $content);

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

    public static function formatCreditCardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'on_website' => $decorator->decorators[0]['attributes']['on_website'] ?? null,
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
                    'feature_title' => $element['attributes']['feature_title'] ?? $element['attributes']['key_features_list-section_feature_title'] ?? null,
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
                            'top_feature_title' => $element['attributes']['top_feature_title'] ?? null,
                            'top_feature_value' => $element['attributes']['top_feature_value'] ?? null,
                            'name' => $element['attributes']['name'],
                            'rating' => $element['attributes']['rating'] ?? null,
                            'cta_text' => $element['attributes']['cta_text'] ?? null,
                            'cta_url' => $element['attributes']['cta_url'] ?? null,
                            'additional_cta_text' => $element['attributes']['additional_cta_text'] ?? null,
                            'inactive' => $element['attributes']['inactive'] ?? false,
                            'key_features' => isset($element['attributes']['key_features']) ? collect($element['attributes']['key_features'])->map(function ($element) {
                                return [
                                    'feature' => $element['attributes']['feature'] ?? null,
                                ];
                            })->flatten(1)
                                ->toArray() : null,
                            'applications' => isset($element['attributes']['application']) ? collect($element['attributes']['application'])->map(function ($element, $key) {
                                return [
                                    $element,
                                ];
                            })->toArray() : null,
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
                            'bonus_text' => $element['attributes']['bonus_text'] ?? null,
                            'bonus_price' => $element['attributes']['bonus_price'] ?? null,
                            'cta_text' => $element['attributes']['cta_text'] ?? null,
                            'cta_url' => $element['attributes']['cta_url'] ?? null,
                            'main_features' => isset($element['attributes']['main_features']) ? collect($element['attributes']['main_features'])->map(function ($element) {
                                return [
                                    'title' => $element['attributes']['title'] ?? null,
                                    'text' => $element['attributes']['text'] ?? null
                                ];
                            })->toArray() : null,
                            'key_features' => isset($element['attributes']['key_features']) ? collect($element['attributes']['key_features'])->map(function ($element) {
                                return [
                                    'feature' => $element['attributes']['feature'] ?? null
                                ];
                            })->flatten(1)
                                ->toArray() : null,
                        ];
                    })->toArray() : null
                ] ?? null
        ];
    }

    public static function formatThreeCardsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'price_options' => $decorator->decorators[0]['attributes']['price_options'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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

    public static function formatOfferSummaryTableSection($decorator)
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
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
            'on_website' => $decorator->decorators[0]['attributes']['on_website'] ?? null,
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

    public static function formatTechTableSection($decorator)
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

    public static function formatGamblerTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'name' => $decorator->decorators[0]['attributes']['name'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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

    public static function formatDetailedBlueTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'short_description' => $decorator->decorators[0]['attributes']['short_description'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'price_options' => $decorator->decorators[0]['attributes']['price_options'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'show_form' => $decorator->show_form ?? false,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'review_text' => $decorator->decorators[0]['attributes']['review_text'] ?? null,
            'learn_more_link' => $decorator->decorators[0]['attributes']['learn_more_link'] ?? null,
            'learn_more_text' => $decorator->decorators[0]['attributes']['learn_more_text'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
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

    public static function formatValuesBulletsTableSection($decorator)
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
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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

    public static function formatValuesContentTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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

    public static function formatValuesPhoneContentTableSection($decorator)
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

    public static function formatValuesContentTwoButtonsTableSection($decorator)
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
            'additional_cta_text' => $decorator->decorators[0]['attributes']['additional_cta_text'] ?? null,
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
                    'table_title' => $decorator['attributes']['table_title'] ?? null,
                    'banner_description' => $decorator['attributes']['banner_description'] ?? null,
                    'banner_cta_text' => $decorator['attributes']['banner_cta_text'] ?? null,
                    'banner_cta_url' => $decorator['attributes']['banner_cta_url'] ?? null,
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
            'key' => $decorator['key'] ?? null,
            'data' => [
                'simple_layout' => $decorator['attributes']['simple_layout'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                'offer' => $decorator['attributes']['offer'] ?? null,
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
                            $element['attributes']['letter'] = substr($element['attributes']['title'] ?? null, 0, 1);
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
                    'key' => $decorator['key'] ?? null,
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
        $content = str_replace('src="https://' . env('AWS_BUCKET', 'trinity-core') . '.s3.' . env('AWS_DEFAULT_REGION', 'us-west-1') . '.amazonaws.com', 'data-src="https://' . env('AWS_BUCKET', 'trinity-core') . '.s3.' . env('AWS_DEFAULT_REGION', 'us-west-1') . '.amazonaws.com', $content);

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
                    'title' => $decorator['attributes']['title'] ?? null,
                    'table_row' => isset($decorator['attributes']['table_row']) ? collect($decorator['attributes']['table_row'])->map(function ($element) {
                        return [
                            'url' => $element['attributes']['url'] ?? null,
                            'plan' => $element['attributes']['plan'] ?? null,
                            'offer' => $element['attributes']['offer'] ?? null,
                            'description' => $element['attributes']['description'] ?? null,
                            'key' => $element['key'] ?? null,
                            'cta_text' => $element['attributes']['cta_text'] ?? null,
                            'price' => $element['attributes']['price'] ?? null,
                            'price_period' =>  $element['attributes']['price_period'] ?? null,
                            'features_title' => $element['attributes']['features_title'] ?? null,
                            'features' => isset($element['attributes']['features']) ? collect($element['attributes']['features'])->map(function ($element) {
                                return [
                                    'feature' => $element['attributes']['feature'] ?? null,
                                ];
                            })->toArray() : null
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

    public static function formatProsConsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'on_website' => $decorator->decorators[0]['attributes']['on_website'] ?? null,
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

    public static function formatOfferBulletsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'bulleted_features' => isset($decorator->decorators[0]['attributes']['bulleted_features']) ? collect($decorator->decorators[0]['attributes']['bulleted_features'])->map(function ($element) {
                return [
                    'value' => $element['attributes']['value'] ?? null,
                ];
            })->toArray() : null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? null,
                    'text' => $element['attributes']['text'] ?? null
                ];
            })->toArray() : null
        ];
    }

    public static function formatHardwareBoxTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'badge_color' => $decorator->decorators[0]['attributes']['badge_color'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'] ?? null,
            'description' => $decorator->decorators[0]['attributes']['description'] ?? null,
            'product_gallery' => $decorator->getMedia('product_gallery_' . $decorator->decorators[0]['key'] ?? '')  ?? null,
            'merchant_list' => isset($decorator->decorators[0]['attributes']['merchant_list']) ? collect($decorator->decorators[0]['attributes']['merchant_list'])->map(function ($element) {
                return [
                    'price' => $element['attributes']['price'] ?? null,
                    'price_options' => $element['attributes']['price_options'] ?? null,
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
            })->toArray() : null,
            'strenghts' => isset($decorator->decorators[0]['attributes']['strenghts']) ? collect($decorator->decorators[0]['attributes']['strenghts'])->map(function ($element) {
                return [
                    'strenght' => $element['attributes']['strenght'] ?? null
                ];
            })->toArray() : null,
            'weaknesses' => isset($decorator->decorators[0]['attributes']['weaknesses']) ? collect($decorator->decorators[0]['attributes']['weaknesses'])->map(function ($element) {
                return [
                    'weakness' => $element['attributes']['weakness'] ?? null
                ];
            })->toArray() : null,
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
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                    'label_title' => $decorator['attributes']['label_title'] ?? null,
                    'title' => $decorator['attributes']['title'] ?? null,
                    'money_description' => $decorator['attributes']['review_description'] ?? null
                ] ?? null
        ];
    }

    public static function formatPostGridSection($decorator)
    {
        $posts = Blog::with('media', 'user.media')->whereHas('categories', function ($q) use ($decorator) {
            $q->where('slug', $decorator['attributes']['category']);
        })
            ->orderBy('updated_at', 'desc')
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
                'comapny' => $decorator['attributes']['comapny'] ?? null,
                'description' => $decorator['attributes']['description'] ?? null,
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

                            $model = collect($element['attributes'])->keys()->last();
                            $page = $model::with('categories', 'media')->whereId($element['attributes'][$model])->first();

                            $category = $page->categories->first();
                            if (\Illuminate\Support\Facades\Route::has('reviews.single')) {
                                $url = route('reviews.single', [$page->categories->first()->slug, $page->slug]);
                            } else {
                                $url = route('reviews.resolve', [$page->categories->first()->slug, $page->slug]);
                            }

                            $key_for_img = collect($page->decorators)->map(function ($item) {
                                if ($item['layout'] === "single-review-table-section") {
                                    return $item['attributes']['table'][0]['key'];
                                }
                            })->reject(function ($value) {
                                return $value === null;
                            })->toArray();

                            $data_for_related = collect($page->decorators)->map(function ($item) {
                                if ($item['layout'] === "single-review-table-section") {
                                    return $item['attributes']['table'][0]['attributes'];
                                }
                            })->reject(function ($value) {
                                return $value === null;
                            })->toArray();

                            $key = array_values($key_for_img)[0] ?? '';

                            if ($data_for_related != []) {
                                $card = collect(array_values($data_for_related)[0])->only([
                                    'name',
                                    'top_feature_value',
                                    'alternative_feature',
                                    'alternative_feature_value',
                                    'application',
                                    'cta_url',
                                    'rating',
                                    'top_feature_title'
                                ])->toArray();
                            } else {
                                $card = [];
                            }

                            $img = $page->getFirstMediaUrl('logo'.'_'.$key);
                            $imgFeature = $page->getFirstMediaUrl('feature');

                            return [
                                $element['attributes'][$model] ?? null,
                                'name' => $page->name,
                                'slug' => $category->slug,
                                'url' => $url,
                                'card' => $card,
                                'img' => $img,
                                'page_status' => $page->status,
                                'title' => $page->title,
                                'page_slug' => $page->slug,
                                'img_feature' => $imgFeature
                            ];
                        })->toArray() : null
                ] ?? null
        ];
    }

    public static function formatStandardDataTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'badge_text' => isset($decorator->decorators[0]['attributes']['badge_text']) ? $decorator->decorators[0]['attributes']['badge_text'] : null,
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'bottom_line' => $decorator->decorators[0]['attributes']['bottom_line'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature'] ?? null,
                ];
            })
                ->flatten(1)
                ->toArray() : null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? null,
                    'value' => $element['attributes']['value'] ?? null,
                ];
            })->toArray() : null,
            'applications' => isset($decorator->decorators[0]['attributes']['application']) ? collect($decorator->decorators[0]['attributes']['application'])->map(function ($element, $key) {
                return [
                    $element ?? null,
                ];
            })->toArray() : null,
        ];
    }

    public static function formatSingleReviewRowSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'key' => $decorator['key'] ?? null,
                    'description' => $decorator['attributes']['description'] ?? null,
                    'price_text' => $decorator['attributes']['price_text'] ?? null,
                    'price' => $decorator['attributes']['price'] ?? null,
                    'price_options' => $decorator['attributes']['price_options'] ?? null,
                    'price_period' => $decorator['attributes']['price_period'] ?? null,
                    'cta_text' => $decorator['attributes']['cta_text'] ?? null,
                    'cta_url' => $decorator['attributes']['cta_url'] ?? null,
                    'best_for_title' => $decorator['attributes']['best_for_title'] ?? null,
                    'best_for_text' => $decorator['attributes']['best_for_text'] ?? null,
                    'main_features' => isset($decorator['attributes']['main_features']) ? collect($decorator['attributes']['main_features'])->map(function ($element) {
                        return [
                            'feature_title' => $element['attributes']['feature_title'] ?? null,
                            'feature_text' => $element['attributes']['feature_text'] ?? null
                        ];
                    })->toArray() : null,
                    'applications' => isset($decorator['attributes']['application']) ? collect($decorator['attributes']['application'])->map(function ($element, $key) {
                        return [
                        $element,
                    ];
                    })->toArray() : null,
                ] ?? null,
        ];
    }

    public static function formatStatsHighlightSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? null,
                'content' => $decorator['attributes']['content'] ?? null,
                'list_type' => $decorator['attributes']['list_type'] ?? null,
                'elements' => isset($decorator['attributes']['stats-highlights']) ? collect($decorator['attributes']['stats-highlights'])
                    ->map(function ($element) {
                        return [
                            'stat' => $element['attributes']['stat'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatEditorsChoiceSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                    'key' => $decorator['key'] ?? null,
                    'title' => $decorator['attributes']['table_title'] ?? null,
                    'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])
                        ->map(function ($element) {
                            return [
                                'key' => $element['key'] ?? null,
                                'title' => $element['attributes']['title'] ?? null,
                                'price' => $element['attributes']['price'] ?? null,
                                'price_period' => $element['attributes']['price_period'] ?? null,
                                'cta_text' => $element['attributes']['cta_text'] ?? null,
                                'cta_url' => $element['attributes']['cta_url'] ?? null,
                                'review_url' => $element['attributes']['review_url'] ?? null,
                            ];
                        })
                        ->toArray() : null
                ] ?? null
        ];
    }

    public static function formatRelatedPostsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'simple_layout' => $decorator['attributes']['simple_layout'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'elements' => isset($decorator['attributes']['grid']) ? collect($decorator['attributes']['grid'])
                    ->map(function ($element) {
                        isset($element['attributes']) ? $model = collect($element['attributes'])->keys()->last() : $model = null;
                        if (isset($model)) {
                            $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first();
                            $routePrefix = strtolower(collect(explode('\\', $model))->last());

                            $category = $page->categories->first();

                            $url = '';
                            $categoryUrl = '';
                            $pageSlug = $page->slug;
                            $categorySlug = $category->slug ?? null;

                            if ($routePrefix === 'blog' || $routePrefix === 'moneypage') {
                                $url = route('resolve.single', [$category->slug, $page->slug]);
                                $categoryUrl = route('resolve', [$category->slug]);
                            }
                            if ($routePrefix === 'news') {
                                $url = route('news.single', [$category->slug, $page->slug]);
                                $categoryUrl = route('news.category', [$category->slug]);
                            }
                            if ($routePrefix === 'reviewpage') {
                                $url = route('reviews.single', [$category->slug, $page->slug]);
                                $categoryUrl = route('reviews.resolve', [$category->slug]);
                            }

                            if ($routePrefix === 'blog' || $routePrefix === 'news') {
                                $description = $page->excerpt;
                            } elseif ($routePrefix === 'moneypage' || $routePrefix === 'reviewpage') {
                                $description = $page->short_description;
                            }
                        }
                        return [
                            'title' => $page['title'] ?? null,
                            'created_at_m' => isset($page) ? $page['created_at']->format('M') : null,
                            'created_at_d' => isset($page) ? $page['created_at']->format('d') : null,
                            'url' => $url ?? null,
                            'category_name' => $category->name ?? null,
                            'image' => isset($page) ? $page->getFirstMediaUrl('feature') : null,
                            'category_url' => $categoryUrl ?? null,
                            'route_prefix' => $routePrefix ?? null,
                            'category_slug' => $categorySlug ?? null,
                            'page_slug' => $pageSlug ?? null,
                            'description' => $description ?? null,
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatTitleImageTextGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'key' => $decorator['key'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                'elements' => isset($decorator['attributes']['columns']) ? collect($decorator['attributes']['columns'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'] ?? null,
                            'text' => $element['attributes']['text'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatProductTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'brand' => $decorator->decorators[0]['attributes']['brand'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'content' => $decorator->decorators[0]['attributes']['content'] ?? null,
            'product_gallery' => $decorator->getMedia('product_gallery_'. $decorator->decorators[0]['key']) ?? null,
            'main_features_table' => isset($decorator->decorators[0]['attributes']['main_features_table']) ? collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? null,
                    'feature_text' => $element['attributes']['feature_text'] ?? null
                ];
            })->toArray() : null,
            'merchant_list' => isset($decorator->decorators[0]['attributes']['merchant_list']) ? collect($decorator->decorators[0]['attributes']['merchant_list'])->map(function ($element) {
                return [
                    'merchant' => $element['attributes']['merchant'] ?? null,
                    'price' => $element['attributes']['price'] ?? null,
                    'cta_text' => $element['attributes']['cta_text'] ?? null,
                    'cta_url' => $element['attributes']['cta_url'] ?? null
                ];
            })->toArray() : null,

        ];
    }

    public static function formatDealsListLayout($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'elements' => isset($decorator['attributes']['table']) ? collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'] ?? null,
                        'brand' => $element['attributes']['brand'] ?? null,
                        'title' => $element['attributes']['title'] ?? null,
                        'website_url' => $element['attributes']['website_url'] ?? null,
                        'bonus_code' => $element['attributes']['bonus_code'] ?? null,
                        'description' => $element['attributes']['description'] ?? null,
                        'button_txt' => $element['attributes']['button_txt'] ?? null,
                    ];
                })->toArray() : null
            ]
        ];
    }

    public static function formatHomeTitleSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => $decorator['attributes'] ?? null
        ];
    }

    public static function formatReviewsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' =>[
                'main_title' => $decorator['attributes']['main_title'] ?? null,
                'subtitle' => $decorator['attributes']['subtitle'] ?? null,
                'section_title' => $decorator['attributes']['section_title'] ?? null,
                'description' => $decorator['attributes']['description'] ?? null,
                'review_categories' => collect(ReviewPageCategory::where('parent_id', '=', $decorator['attributes']['review_category'])->get())
                    ->map(function ($element) {
                        return [
                            'name' => $element->name,
                            'slug' => $element->slug,
                        ];
                    })->toArray(),
                'image_right' => $decorator['attributes']['image_right'] ?? null,
            ],
        ];
    }

    public static function formatMoneyPageSliderSection($decorator)
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
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? null,
                'content' => $decorator['attributes']['content'] ?? null,
                'elements' => isset($decorator['attributes']['columns']) ? collect($decorator['attributes']['columns'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'] ?? null,
                            'description' => $element['attributes']['description'] ?? null
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatHomeTopPostsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? null,
                'elements' => isset($decorator['attributes']['slider']) ? collect($decorator['attributes']['slider'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'] ?? '')->keys()->last();
                        $page = $model::whereId($element['attributes'][$model] ?? '')->with('categories', 'media')->first();
                        $category = $page->categories->whereNotNull('parent_id')->first();
                        $parentCategory = $category->parent()->first();

                        return [
                            'title' => $page->title,
                            'slug' => $page->slug,
                            'category_name' => $category->name,
                            'image' => $page->getFirstMediaUrl('feature'),
                            'category_slug' => $category->slug,
                            'parent_slug' => $parentCategory->slug
                        ];
                    })
                    ->toArray() : null
            ]
        ];
    }

    public static function formatSingleReviewCompareFeaturesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'key' => $decorator['key'] ?? null,
            'data' => [
                'winner_best_for' => $decorator['attributes']['winner_best_for'] ?? null,
                'winner_title' => $decorator['attributes']['winner_title'] ?? null,
                'loser_best_for' => $decorator['attributes']['loser_best_for'] ?? null,
                'loser_title' => $decorator['attributes']['loser_title'] ?? null,
                'main_features' => isset($decorator['attributes']['main_features']) ? collect($decorator['attributes']['main_features'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'] ?? null,
                        'winner_features' => $element['attributes']['winner_features'] ?? null,
                        'loser_features' => $element['attributes']['loser_features'] ?? null
                    ];
                })->toArray() : null
            ]
        ];
    }

    public static function formatProductsCompareSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? null,
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? null,
            'key' => $decorator->decorators[0]['key'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'brand' => $decorator->decorators[0]['attributes']['brand'] ?? null,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? null,
            'cta_url' =>  $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'main_features' => isset($decorator->decorators[0]['attributes']['main_features']) ? collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? null,
                    'text' => $element['attributes']['text'] ?? null
                ];
            })->toArray() : null,
            'key_features' => isset($decorator->decorators[0]['attributes']['key_features']) ? collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature'] ?? null
                ];
            })->flatten(1)
                ->toArray() : null
        ];
    }

    public static function formatNotablePostsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'title' => $decorator['attributes']['title'] ?? null,
                'elements' => isset($decorator['attributes']['articles']) ? collect($decorator['attributes']['articles'])
                    ->map(function ($element) {
                        return [
                            'publisher' => $element['attributes']['publisher'] ?? null,
                            'name' => $element['attributes']['name'] ?? null,
                            'url' => $element['attributes']['url'] ?? null,
                        ];
                    })
                    ->toArray() : null
            ] ?? null
        ];
    }

    public static function formatContactPageSection($decorator)
    {
        return [
            'layout' => $decorator['layout'] ?? null,
            'data' => [
                'quote_title' => $decorator['attributes']['quote_title'] ?? null,
                'intro_text' => $decorator['attributes']['intro_text'] ?? null,
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'] ?? null,
                'description' => $decorator['attributes']['description'] ?? null,
            ] ?? null,
        ];
    }
}
