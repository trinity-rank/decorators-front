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
        'three-column-section' => 'formatThreeColumnSection',                       // FORTUNLY, SBG, RW42
        'title-section' => 'formatTitleSection',                                    // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'image-three-rows-section' => 'formatImageThreeRowsSection',                // FORTUNLY, SBG, RW42, Techjury, TechTribunal
        'youtube-section' => 'formatYoutubeSection',                                // FORTUNLY, SBG, RW42, Techjury, TechTribunal
        'content-section' => 'formatContentSection',                                // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'faq-section' => 'formatFaqSection',                                        // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'sources-section' => 'formatSourcesSection',                                // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'methodology-section' => 'formatMethodologySection',                        // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'featured-snippet-section' => 'formatFeaturedSnippetSection',               // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'show-more-section' => 'formatShowMoreSection',                             // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'single-review-table-section' => 'formatSingleReviewTableSection',          // FORTUNLY, SBG, RW42, Techjury, TechTribunal
        'review-compare-section' => 'formatReviewCompareSection',                   // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal
        'content-table' => 'formatContentTableSection',                             // FORTUNLY, SBG, RW42, Techjury, TechTribunal
        'table-section' => 'parseTableSection',                                     // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal
        'offer-summary-table-section' => 'parseOfferSummaryTableSection',           // FORTUNLY, SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech

        'values-content-two-buttons-table-sections' => 'parseValuesContentTwoButtonsTableSection',  // FORTUNLY, SBG
        'detailed-blue-table-section' => 'parseDetailedBlueTableSection',           // FORTUNLY, SBG
        'values-content-table-section' => 'parseValuesContentTableSection',         // FORTUNLY, SBG
        'values-phone-content-table-section' => 'parseValuesPhoneContentTableSection', // FORTUNLY, SBG

        'authors-section' => 'authorsSection',                                      // SBG, RW42, Techjury [ONLY]

        'text-banner' => 'formatTextBannerSection',                                 // FORTUNLY [ONLY]

        'review-score-compare-section' => 'formatReviewScoreCompareSection',        // SBG [ONLY]
        'text-left-image-right-section' => 'formatTextLeftImageRightSection',       // SBG [ONLY]
        'divide-by-letters-section' => 'formatDivideByLettersSection',              // SBG [ONLY]

        'image-and-content-side-by-side-section' => 'imageAndContentSideBySideSection', // RW42, Techjury [ONLY]
        'single-review-box-with-rating-section' => 'singleReviewBoxWithRatingSection',  // RW42, Techjury [ONLY]
        'single-review-hardware-box-section' => 'singleReviewHardwareBoxSection',       // RW42, Techjury [ONLY]
        'single-review-compare-section' => 'singleReviewCompareSection',                // RW42, Techjury [ONLY]
        'small-three-column-table' => 'smallThreeColumnTableSection',                   // RW42, Techjury [ONLY]
        'review-grid-section' => 'formatReviewGridSection',                             // RW42 [ONLY]
        'content-with-background-section' => 'formatContentWithBackgroundSection',      // RW42, Techjury [ONLY]
        'content-in-quotes-section' => 'formatContentInQuotesSection',                  // RW42, Techjury [ONLY]
        'review-pricing-grid-section' => 'formatReviewPricingGridSection',              // RW42, Techjury [ONLY]
        'review-strengths-weaknesses-section' => 'formatReviewStrengthsWeaknessesSection', // RW42, Techjury [ONLY]
        'pros-cons-table-section' => 'parseProsConsTableSection',                       // RW42 [ONLY]
        'offer-bullets-table-section' => 'parseOfferBulletsTableSection',               // RW42, Techjury, TechTribunal [ONLY]
        'hardware-box-table-section' => 'parseHardwareBoxTableSection',                 // RW42, Techjury, KommandoTech [ONLY]

        'disclaimer-section' => 'disclaimerSection',                                    // Techjury [ONLY]
        'single-review-box-with-features-section' => 'singleReviewBoxWithFeaturesSection',  // Techjury [ONLY]
        'money-page-grid-section' => 'formatMoneyPageGridSection',                      // Techjury [ONLY]
        'post-grid-section' => 'formatPostGridSection',                                 // Techjury [ONLY]
        'background-checks-section' => 'formatBackgroundChecksSection',                 // Techjury [ONLY]
        'related-review-section' => 'formatRelatedReviewSection',                       // Techjury [ONLY]

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
        'tech-table-section' => 'parseTechTableSection', // FORTUNLY (DONE),  SBG,  RW42, Techjury, TechTribunal <-- dif text (apply, visit)
        'related-product-section' => 'formatRelatedProductSection', // SBG != RW42 == Techjury
        'grid-section' => 'formatGridSection', // FORTUNLY (DONE), SBG , RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'standard-table-section' => 'parseStandardTableSection', // FORTUNLY (DONE), SBG, RW42, Techjury, TechTribunal
        'credit-card-table-section' => 'parseCreditCardTableSection', // FORTUNLY (DONE), SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'three-cards-table-section' => 'parseThreeCardsTableSection', // FORTUNLY (DONE), SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech
        'gambler-table-section' => 'parseGamblerTableSection', // FORTUNLY (DONE), SBG, RW42, Techjury, TechTribunal
        'values-bullets-table-section' => 'parseValuesBulletsTableSection', // FORTUNLY (DONE), SBG, RW42, Techjury, Dataprot, TechTribunal, KommandoTech

        // DIF NAME

        // 'detailed-blue-table-section' => 'formatDetailedBlueTableSection', // X2 dif name RW42, Techjury
        // 'values-content-table-section' => 'formatValuesContentTableSection', // X2 dif name RW42, Techjury, TechTribunal
        // 'values-phone-content-table-section' => 'formatValuesPhoneContentTableSection', // X2 dif name RW42, Techjury, TechTribunal
        // 'values-content-two-buttons-table-sections' => 'formatValuesContentTwoButtonsTableSection', // X2 dif name RW42, Techjury, TechTribunal

        // Techjury problems

//        'review-grid-section' => 'formatReviewGridSection',
//        'three-column-section' => 'formatThreeColumnSection',
//        'pros-cons-table-section' => 'parseProsConsTableSection', <- dif text ('apply now,.. )

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
        // Fortune      - CHECK,
        // SBG          - CHECK,
        // Review42     - CHECK,
        // Techjury     - CHECK,
        // Techjury     - CHECK,
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
        $tableElements = json_decode($decorator['attributes']['table'][0]['attributes']['operaters']);
        $operaters = Operater::whereIn('id', $tableElements)->with('media')->orderByRaw('FIELD(id,' . implode(",", $tableElements) . ')')->get();

        $data = [
            'layout' => $decorator['attributes']['table'][0]['layout'],
            'data' => [
                'table_title' => $tableTitle,
                'elements' => $operaters->map(function ($operater) {
                    $tableParser = self::$decoratorMapper[$operater['table_type']];
                    $operater['image'] = $operater->getFirstMediaUrl('logo') ?? "";
                    $operater = self::{$tableParser}($operater) ?? [];
                    return $operater;
                })->toArray()
            ]
        ];

        return $data;
    }

    public static function formatThreeColumnSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => collect($decorator['attributes'])
                ->flatten(1)
                ->map(function ($row) {
                    return $row['attributes'];
                })
                ->toArray()
        ];
    }

    public static function formatTitleSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => $decorator['attributes']
        ];
    }

    public static function formatImageThreeRowsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'title_label' => $decorator['attributes']['title_label'] ?? null,
                'title' => $decorator['attributes']['title'],
                'description' => $decorator['attributes']['description'],
                'elements' => collect($decorator['attributes']['rows'])
                    ->map(function ($element) {
                        return $element['attributes'];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatYoutubeSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'description' => $decorator['attributes']['description'],
                'elements' => collect($decorator['attributes']['youtube'])
                    ->map(function ($element) {
                        return [
                            'key' => $element['key'],
                            'title' => $element['attributes']['title'],
                            'description' => $element['attributes']['description'],
                            'url' => $element['attributes']['url'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'label_title' => $decorator['attributes']['label_title'],
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['grid'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first();
                        $routePrefix = strtolower(collect(explode('\\', $model))->last());
                        $category = $page->categories->first();
                        return [
                            'title' => $element['attributes']['title'],
                            'description' => $element['attributes']['description'],
                            'button_text' => $element['attributes']['button_text'],
                            'routePrefix' => $routePrefix,
                            'page' => $page,
                            'category' => $category,
                            'category_name' => $category->name,
                            'category_icon' => $category->getFirstMediaUrl('icon'),
                            'background_color' => $element['attributes']['background_color'] ?? 'bg-beige-bg',
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function parseStandardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'],
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? "",
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? "",
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'on_website' => $decorator->decorators[0]['attributes']['on_website'] ?? null,
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'best_for' => $decorator->decorators[0]['attributes']['best_for'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'bottom_line' => $decorator->decorators[0]['attributes']['bottom_line'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature']
                ];
            })
                ->flatten(1)
                ->toArray(),
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'],
                    'value' => $element['attributes']['value'],
                ];
            })->toArray(),
        ];
    }

    public static function formatContentSection($decorator)
    {
        // Fix iframe for responsive
        $content = str_replace("<iframe", "<div class='iframe-wrapper'><iframe", $decorator['attributes']['content']);
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
            'layout' => $decorator['layout'],
            'data' => $content
        ];
    }

    public static function formatFaqSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'] ?? 'FAQ',
                'elements' => collect($decorator['attributes']['faq'])
                    ->map(function ($element) {
                        return [
                            'question' => $element['attributes']['question'],
                            'answer' => $element['attributes']['answer'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatSourcesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'elements' => collect($decorator['attributes']['sources'])
                    ->map(function ($element) {
                        return [
                            'name' => $element['attributes']['name'],
                            'url' => $element['attributes']['url'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatMethodologySection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title_label' => $decorator['attributes']['title_label'],
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['methodology'])
                    ->map(function ($element) {
                        return [
                            'title' => $element['attributes']['title'],
                            'content' => $element['attributes']['content'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatFeaturedSnippetSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'title_label' => $decorator['attributes']['title_label'],
                'title' => $decorator['attributes']['title'],
                'list_type' => $decorator['attributes']['list_type'],
                'bottom_text' => $decorator['attributes']['bottom_text'] ?? '',
                'elements' => collect($decorator['attributes']['featured-snippets'])
                    ->map(function ($element) {
                        return [
                            'snippet' => $element['attributes']['snippet'],
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatShowMoreSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => (new MarkupFixer())->fix($decorator['attributes']['content'])
        ];
    }

    public static function parseCreditCardTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'],
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'],
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'],
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'],
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'credit_score_min' => $decorator->decorators[0]['attributes']['credit_score_min'],
            'credit_score_max' => $decorator->decorators[0]['attributes']['credit_score_max'],
            'price_title' => $decorator->decorators[0]['attributes']['price_title'],
            'price' => $decorator->decorators[0]['attributes']['price'],
            'price_text' => $decorator->decorators[0]['attributes']['price_text'],
            'website_url' => $decorator->decorators[0]['attributes']['website_url'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? "",
            'detail_title' => $decorator->decorators[0]['attributes']['detail_title'],
            'detail_text' => $decorator->decorators[0]['attributes']['detail_text'],
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'] ?? '',
                    'feature_text' => $element['attributes']['feature_text'] ?? ''
                ];
            })
                ->toArray(),
            'rates_and_fees' => collect($decorator->decorators[0]['attributes']['rates_&_fees'] ?? null)->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'] ?? '',
                    'value' => $element['attributes']['value'] ?? '',
                ];
            })->toArray(),
        ];
    }

    public static function formatSingleReviewTableSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'intro_bonus_title' => $element['attributes']['intro_bonus_title'],
                        'intro_bonus_price' => $element['attributes']['intro_bonus_price'],
                        'intro_bonus_text' => $element['attributes']['intro_bonus_text'],
                        'rating' => $element['attributes']['rating'],
                        'cta_text' => !empty($element['attributes']['cta_text']) ? $element['attributes']['cta_text'] : 'Visit Site',
                        'cta_url' => $element['attributes']['cta_url'],
                        'inactive' => $element['attributes']['inactive'] ?? false,
                        'main_features' => collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'feature_title' => $element['attributes']['feature_title'],
                                'feature_text' => $element['attributes']['feature_text']
                            ];
                        })->toArray(),
                        'strenghts' => collect($element['attributes']['strenghts'])->map(function ($element) {
                            return [
                                'strenght' => $element['attributes']['strenght']
                            ];
                        })->toArray(),
                        'weaknesses' => collect($element['attributes']['weaknesses'])->map(function ($element) {
                            return [
                                'weakness' => $element['attributes']['weakness']
                            ];
                        })->toArray(),
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatReviewCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'table_title' => $decorator['attributes']['table_title'],
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'title' => $element['attributes']['title'],
                        'main_features' => collect($element['attributes']['main_features'])->map(function ($element) {
                            return [
                                'title' => $element['attributes']['title'],
                                'text' => $element['attributes']['text']
                            ];
                        })->toArray(),
                        'cta_text' => !empty($element['attributes']['cta_text']) ? $element['attributes']['cta_text'] : '',
                        'cta_url' => !empty($element['attributes']['cta_url']) ? $element['attributes']['cta_url'] : '',
                    ];
                })->toArray()
            ]
        ];
    }

    public static function parseThreeCardsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'],
            'title' => $decorator->decorators[0]['attributes']['title'],
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? "",
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? "",
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? "",
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? null,
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? null,
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'cta_lock' => $decorator->decorators[0]['attributes']['cta_lock'] ?? "",
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'phone' => $decorator->decorators[0]['attributes']['phone'],
            'main_features_table' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_value' => $element['attributes']['feature_value']
                ];
            })->toArray(),
            'content_tabs' => collect($decorator->decorators[0]['attributes']['content_tabs'])->map(function ($element) {
                return [
                    'tab_title' => $element['attributes']['tab_title'],
                    'tab_content' => $element['attributes']['tab_content']
                ];
            })->toArray(),
        ];
    }

    public static function parseOfferSummaryTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'key' => $decorator->decorators[0]['key'] ?? null,
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? $decorator->decorators[0]['attributes']['title'] ?? '',
            'title' => $decorator->decorators[0]['attributes']['title'],
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'] ?? null,
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Get A Quote',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'bottom_line_title' => $decorator->decorators[0]['attributes']['bottom_line_title'] ?? "",
            'bottom_line_text' => $decorator->decorators[0]['attributes']['bottom_line_text'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'] ?? null,
            'special_offer_title' => $decorator->decorators[0]['attributes']['special_offer_title'],
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'special_offer_text' => $decorator->decorators[0]['attributes']['special_offer_text'],
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
        ];
    }

    public static function parseTechTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'key' => $decorator->decorators[0]['key'] ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'learn_more_url' => $decorator->decorators[0]['attributes']['learn_more_url'],
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature' => $element['attributes']['feature']
                ];
            })->toArray(),
        ];
    }

    public static function parseGamblerTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'] ?? "",
            'name' => $decorator->decorators[0]['attributes']['name'] ?? null,
            'banner_description' => $decorator->decorators[0]['attributes']['banner_description'] ?? "",
            'banner_cta_text' => $decorator->decorators[0]['attributes']['banner_cta_text'] ?? "",
            'banner_cta_url' => $decorator->decorators[0]['attributes']['banner_cta_url'] ?? "",
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
        ];
    }

    public static function parseDetailedBlueTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'] ?? "",
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'title' => $decorator->decorators[0]['attributes']['title'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'short_description' => $decorator->decorators[0]['attributes']['short_description'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Open Account',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'content' => $decorator->decorators[0]['attributes']['content'],
            'review_text' => $decorator->decorators[0]['attributes']['review_text'] ?? null,
            'learn_more_link' => $decorator->decorators[0]['attributes']['learn_more_link'] ?? null,
            'learn_more_text' => $decorator->decorators[0]['attributes']['learn_more_text'] ?? null,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
            'pros' => collect($decorator->decorators[0]['attributes']['pros'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['pro']
                ];
            })
                ->flatten(1)
                ->toArray(),
            'cons' => collect($decorator->decorators[0]['attributes']['cons'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['con']
                ];
            })
                ->flatten(1)
                ->toArray(),
        ];

    }

    public static function parseValuesBulletsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? "",
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'credit_score_min' => $decorator->decorators[0]['attributes']['credit_score_min'],
            'credit_score_max' => $decorator->decorators[0]['attributes']['credit_score_max'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'main_features_table' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
            'main_features_bullets' => collect($decorator->decorators[0]['attributes']['main_features_bullets'])->map(function ($element) {
                return [
                    'feature_item' => $element['attributes']['feature_item'],
                ];
            })->toArray(),
        ];
    }

    public static function parseValuesContentTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'best_for' => $decorator->decorators[0]['attributes']['best_for'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Apply Now',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'comperable' => $decorator->decorators[0]['attributes']['comperable'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'main_features_table' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
        ];
    }

    public static function parseValuesPhoneContentTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Apply Now',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'phone' => $decorator->decorators[0]['attributes']['phone'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'main_features_table' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
        ];
    }

    public static function parseValuesContentTwoButtonsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'] ?? null,
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'subtitle' => $decorator->decorators[0]['attributes']['subtitle'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Open an Account',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_value' => $element['attributes']['feature_value']
                ];
            })->toArray(),
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
        ];
    }

    public static function formatContentTableSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title_columns' => collect($decorator['attributes']['title_columns'])->map(function ($element) {
                    return [
                        $element['attributes']['column_title']
                    ];
                })->flatten(1)->toArray(),
                'elements' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'table_columns' => collect($element['attributes']['table_columns'])->map(function ($element) {
                            return [
                                'column_value' => $element['attributes']['column_value'],
                                'column_link' => $element['attributes']['column_link'] ?? null
                            ];
                        })->toArray(),
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatTextBannerSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'subtitle' => $decorator['attributes']['subtitle'],
                'cta_text' => $decorator['attributes']['cta_text'],
                'cta_url' => $decorator['attributes']['cta_url'],
            ]
        ];
    }

    public static function formatTextLeftImageRightSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'featured' => $decorator['attributes']['featured'],
                'elements' => collect($decorator['attributes']['rows'])
                    ->map(function ($element) {
                        return $element['attributes'];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function formatReviewScoreCompareSection($decorator)
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
                        'review_url' => $element['attributes']['review_url'],
                    ];
                })->toArray()
            ]
        ];
    }

    public static function authorsSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'users' => User::whereIn('id', json_decode($decorator['attributes']['authors']))->get(),
                'description' => $decorator['attributes']['description']
            ]
        ];
    }

    public static function formatDivideByLettersSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'main_title' => $decorator['attributes']['main_title'],
                'elements' => collect($decorator['attributes']['paragraph'])
                    ->map(function ($element) {
                        $element['attributes']['letter'] = substr($element['attributes']['title'], 0, 1);
                        return $element['attributes'];
                    })
            ]
        ];
    }

    public static function formatRelatedProductSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['related-products'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        $page = $model::whereId($element['attributes'][$model])->with('categories', 'categories.media')->first();

                        $category = $page->categories->first();
                        $url = route('resolve', [$page->slug]);

                        return [
                            'name' => $page->name,
                            'slug' => $category->slug,
                            'url' => $url
                        ];
                    })
                    ->toArray()
            ]
        ];
    }

    public static function imageAndContentSideBySideSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'subtitle' => $decorator['attributes']['subtitle'],
                'description' => $decorator['attributes']['description'],
                'button-text' => $decorator['attributes']['button_text'],
                'button-url' => $decorator['attributes']['button_url'],
                'image-right' => $decorator['attributes']['pull_image_right'],
            ]
        ];
    }

    public static function singleReviewBoxWithRatingSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'fact_checked' => $decorator['attributes']['fact_checked'],
                'cta_url' => $decorator['attributes']['cta_url'],
                'cta_text' => $decorator['attributes']['cta_text'],
                'price_text' => $decorator['attributes']['price_text'],
                'price' => $decorator['attributes']['price'],
                'main_features' => collect($decorator['attributes']['main_features'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'],
                        'feature_text' => $element['attributes']['feature_text'] ?? '',
                        'rating' => $element['attributes']['rating'] ?? null
                    ];
                })->toArray()
            ]
        ];
    }

    public static function singleReviewHardwareBoxSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'fact_checked' => $decorator['attributes']['fact_checked'],
                'rating' => $decorator['attributes']['rating'],
                'merchant_list' => collect($decorator['attributes']['merchant_list'])->map(function ($element) {
                    return [
                        'price' => $element['attributes']['price'],
                        'cta_url' => $element['attributes']['cta_url'],
                        'cta_text' => $element['attributes']['cta_text'],
                        'merchant' => $element['attributes']['merchant'],
                    ];
                })->toArray(),
                'main_features' => collect($decorator['attributes']['main_features_table'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'],
                        'text' => $element['attributes']['feature_text']
                    ];
                })->toArray()
            ]
        ];
    }

    public static function singleReviewCompareSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'fact_checked' => $decorator['attributes']['fact_checked'],
                'winner_title' => $decorator['attributes']['winner_title'],
                'winner_rating' => $decorator['attributes']['winner_rating'],
                'winner_cta_text' => $decorator['attributes']['winner_cta_text'],
                'winner_cta_url' => $decorator['attributes']['winner_cta_url'],
                'loser_title' => $decorator['attributes']['loser_title'],
                'loser_rating' => $decorator['attributes']['loser_rating'],
                'loser_cta_text' => $decorator['attributes']['loser_cta_text'],
                'loser_cta_url' => $decorator['attributes']['loser_cta_url'],
                'main_features' => collect($decorator['attributes']['main_features'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'],
                        'winner_text' => $element['attributes']['winner_text'],
                        'loser_text' => $element['attributes']['loser_text']
                    ];
                })->toArray()
            ]
        ];
    }

    public static function smallThreeColumnTableSection($decorator)
    {

        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'text' => $decorator['attributes']['text'] ?? '',
                'table' => collect($decorator['attributes']['table'])->map(function ($element) {
                    return [
                        'key' => $element['key'],
                        'title' => $element['attributes']['title'],
                        'review_url' => $element['attributes']['review_url'],
                        'main_features' => collect($element['attributes']['main_features'])->map(function ($subelement) {
                            return [
                                'feature_title' => $subelement['attributes']['feature_title'],
                                'feature_text' => $subelement['attributes']['feature_text'],
                            ];
                        })->toArray()
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatReviewGridSection($decorator)
    {
        $reviews = ReviewPageCategory::orderBy('created_at', 'desc')->limit(9)->with('media')->get();
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'reviews' => $reviews,
                'label_title' => $decorator['attributes']['label_title'],
                'title' => $decorator['attributes']['title'],
                'review_description' => $decorator['attributes']['review_description']
            ]
        ];
    }

    public static function formatContentWithBackgroundSection($decorator)
    {
        // Fix iframe for responsive
        $content = str_replace("<iframe", "<div class='iframe-wrapper'><iframe", $decorator['attributes']['content']);
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
            'layout' => $decorator['layout'],
            'data' => $content
        ];
    }

    public static function formatContentInQuotesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'content' => $decorator['attributes']['content'],
            ]
        ];
    }

    public static function formatReviewPricingGridSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'table_row' => collect($decorator['attributes']['table_row'])->map(function ($element) {
                    return [
                        'url' => $element['attributes']['url'],
                        'plan' => $element['attributes']['plan'],
                        'offer' => $element['attributes']['offer'],
                        'description' => $element['attributes']['description'],
                    ];
                })->toArray()
            ]
        ];
    }

    public static function formatReviewStrengthsWeaknessesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'best_for' => $decorator['attributes']['best_for'],
                'strengths' => collect($decorator['attributes']['strengths'])->map(function ($element) {
                    return [
                        'text' => $element['attributes']['strength'],
                    ];
                })->toArray(),
                'weaknesses' => collect($decorator['attributes']['weaknesses'])->map(function ($element) {
                    return [
                        'text' => $element['attributes']['weakness'],
                    ];
                })->toArray()
            ]
        ];
    }

    public static function parseProsConsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'],
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'key' => $decorator->decorators[0]['key'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'title' => $decorator->decorators[0]['attributes']['title'],
            'best_for' => $decorator->decorators[0]['attributes']['best_for'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'offer_text' => $decorator->decorators[0]['attributes']['offer_text'] ?? null,
            'offer_price' => $decorator->decorators[0]['attributes']['offer_price'] ?? null,
            'offer_period' => $decorator->decorators[0]['attributes']['offer_period'] ?? null,
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Visit Website',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'review_url' => $decorator->decorators[0]['attributes']['review_url'],
            'content' => $decorator->decorators[0]['attributes']['content'],
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })->toArray(),
            'pros_list' => collect($decorator->decorators[0]['attributes']['pros_list'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['text']
                ];
            })
                ->flatten(1)
                ->toArray(),
            'cons_list' => collect($decorator->decorators[0]['attributes']['cons_list'])->map(function ($element) {
                return [
                    'item' => $element['attributes']['text']
                ];
            })
                ->flatten(1)
                ->toArray(),
        ];
    }

    public static function parseOfferBulletsTableSection($decorator)
    {
        return [
            'id' => $decorator['id'],
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'alt' => $decorator->getFirstMedia('logo')->getCustomProperty('alt') ?? $decorator->decorators[0]['attributes']['title'] ?? '',
            'key' => $decorator->decorators[0]['key'],
            'title' => $decorator->decorators[0]['attributes']['title'],
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'],
            'rating' => $decorator->decorators[0]['attributes']['rating'] ?? null,
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Get A Quote',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'bulleted_features' => collect($decorator->decorators[0]['attributes']['bulleted_features'])->map(function ($element) {
                return [
                    'value' => $element['attributes']['value']
                ];
            })->toArray(),
        ];
    }

    public static function parseHardwareBoxTableSection($decorator)
    {
        return [
            'id' => $decorator['id'],
            'table_type' => $decorator['table_type'],
            'name' => $decorator['name'] ?? null,
            'image' => $decorator->getFirstMediaUrl('logo') ?? "",
            'key' => $decorator->decorators[0]['key'],
            'title' => $decorator->decorators[0]['attributes']['title'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'brand_name' => $decorator->decorators[0]['attributes']['brand_name'],
            'description' => $decorator->decorators[0]['attributes']['description'],
            'product_gallery' => $decorator->getMedia('product_gallery_' . $decorator->decorators[0]['key']) ?? '',
            'merchant_list' => collect($decorator->decorators[0]['attributes']['merchant_list'])->map(function ($element) {
                return [
                    'price' => $element['attributes']['price'],
                    'currency' => $element['attributes']['merchant-list_currency'] ?? '$',
                    'cta_url' => $element['attributes']['cta_url'],
                    'cta_text' => $element['attributes']['cta_text'],
                    'merchant' => $element['attributes']['merchant'],
                ];
            })->toArray(),
            'main_features' => collect($decorator->decorators[0]['attributes']['main_features_table'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['feature_title'],
                    'text' => $element['attributes']['feature_text']
                ];
            })->toArray()
        ];
    }

    public static function disclaimerSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'description' => $decorator['attributes']['description']
            ]
        ];
    }

    public static function singleReviewBoxWithFeaturesSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'fact_checked' => $decorator['attributes']['fact_checked'],
                'description' => $decorator['attributes']['description'],
                'cta_url' => $decorator['attributes']['cta_url'],
                'cta_text' => $decorator['attributes']['cta_text'],
                'price_text' => $decorator['attributes']['price_text'],
                'price' => $decorator['attributes']['price'],
                'main_features' => collect($decorator['attributes']['main_features'])->map(function ($element) {
                    return [
                        'title' => $element['attributes']['feature_title'],
                        'feature' => $element['attributes']['feature_text']
                    ];
                })->toArray(),
                'works_on' => $decorator['attributes']['works_on'] ?? null,
            ]
        ];
    }

    public static function formatMoneyPageGridSection($decorator)
    {
        $moneypage_categories = MoneyPageCategory::orderBy('created_at', 'desc')->whereNotNull('parent_id')->distinct()->limit(16)->get();
        return [
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'moneypage_categories' => $moneypage_categories,
                'label_title' => $decorator['attributes']['label_title'],
                'title' => $decorator['attributes']['title'],
                'money_description' => $decorator['attributes']['review_description']
            ]
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
            'layout' => $decorator['layout'],
            'key' => $decorator['key'],
            'data' => [
                'posts' => $posts,
                'category' => $decorator['attributes']['category'],
                'title' => $decorator['attributes']['title'],
                'description' => $decorator['attributes']['description']
            ]
        ];
    }

    public static function formatBackgroundChecksSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title']
            ]
        ];
    }

    public static function formatRelatedReviewSection($decorator)
    {
        return [
            'layout' => $decorator['layout'],
            'data' => [
                'title' => $decorator['attributes']['title'],
                'elements' => collect($decorator['attributes']['related-reviews'])
                    ->map(function ($element) {
                        $model = collect($element['attributes'])->keys()->last();
                        return $element['attributes'][$model];
                    })->toArray()
            ]
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
