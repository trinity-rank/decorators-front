<?php

namespace Trinityrank\DecoratorsFront\Models;

use App\Models\Operater;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use TOC\MarkupFixer;

class Decorator extends Model
{
    protected static $decoratorMapper = [
        'three-column-section' => 'formatThreeColumnSection',
        'title-section' => 'formatTitleSection',
        'image-three-rows-section' => 'formatImageThreeRowsSection',
        'youtube-section' => 'formatYoutubeSection',
        'grid-section' => 'formatGridSection',
        'standard-table-section' => 'parseStandardTableSection',
        'content-section' => 'formatContentSection',
        'faq-section' => 'formatFaqSection',
        'sources-section' => 'formatSourcesSection',
        'methodology-section' => 'formatMethodologySection',
        'featured-snippet-section' => 'formatFeaturedSnippetSection',
        'show-more-section' => 'formatShowMoreSection',
        'credit-card-table-section' => 'parseCreditCardTableSection',
        'single-review-table-section' => 'formatSingleReviewTableSection',
        'review-compare-section' => 'formatReviewCompareSection',
        'three-cards-table-section' => 'parseThreeCardsTableSection',
        'offer-summary-table-section' => 'parseOfferSummaryTableSection',
        'tech-table-section' => 'parseTechTableSection',
        'gambler-table-section' => 'parseGamblerTableSection',
        'detailed-blue-table-section' => 'parseDetailedBlueTableSection',
        'values-bullets-table-section' => 'parseValuesBulletsTableSection',
        'values-content-table-section' => 'parseValuesContentTableSection',
        'values-phone-content-table-section' => 'parseValuesPhoneContentTableSection',
        'values-content-two-buttons-table-sections' => 'parseValuesContentTwoButtonsTableSection',
        'content-table' => 'formatContentTableSection',
        'text-banner' => 'formatTextBannerSection',
        'table-section' => 'parseTableSection',

        // Fortunly
        'text-banner' => 'formatTextBannerSection',

        // SBG
        'review-score-compare-section' => 'formatReviewScoreCompareSection',
        'text-left-image-right-section' => 'formatTextLeftImageRightSection',
        'authors-section' => 'authorsSection',
        'divide-by-letters-section' => 'formatDivideByLettersSection',
        'related-product-section' => 'formatRelatedProductSection',
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
        $operaters = Operater::whereIn('id', $tableElements)->with('media')->orderByRaw('FIELD(id,'.implode(",",$tableElements).')')->get();

        $data = [
            'layout' => $decorator['attributes']['table'][0]['layout'],
            'data' => [
                'table_title' => $tableTitle,
                'elements' => $operaters->map( function( $operater ) {
                    $tableParser = self::$decoratorMapper[$operater['table_type']];
                    $operater['image'] = $operater->getFirstMediaUrl('logo') ?? "";
                    $operater = \App\Models\Decorator::{$tableParser}($operater) ?? [];
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
                        // ray($page);
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
                            'title' => $element['attributes']['title'],
                            'description' => $element['attributes']['description'],
                            'button_text' => $element['attributes']['button_text'],
                            'url' => $url,
                            'category_name' => $category->name,
                            'category_icon' => $category->getFirstMediaUrl('icon'),
                            'category_url' => $categoryUrl,
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
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'] ?? null,
            'cta_text' => $decorator->decorators[0]['attributes']['cta_text'] ?? 'Apply now',
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

    public static function formatContentSection($decorator) {
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
                'title' => $decorator['attributes']['title'],
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

    public static function formatShowMoreSection($decorator) {
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
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Open Account',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'credit_score_min' => $decorator->decorators[0]['attributes']['credit_score_min'],
            'credit_score_max' => $decorator->decorators[0]['attributes']['credit_score_max'],
            'price_title' => $decorator->decorators[0]['attributes']['price_title'],
            'price' => $decorator->decorators[0]['attributes']['price'],
            'price_text' => $decorator->decorators[0]['attributes']['price_text'],
            'website_url' => $decorator->decorators[0]['attributes']['website_url'],
            'detail_title' => $decorator->decorators[0]['attributes']['detail_title'],
            'detail_text' => $decorator->decorators[0]['attributes']['detail_text'],
            'key_features' => collect($decorator->decorators[0]['attributes']['key_features'])->map(function ($element) {
                return [
                    'feature_title' => $element['attributes']['feature_title'],
                    'feature_text' => $element['attributes']['feature_text']
                ];
            })
                ->toArray(),
            'rates_and_fees' => collect($decorator->decorators[0]['attributes']['rates_&_fees'])->map(function ($element) {
                return [
                    'title' => $element['attributes']['title'],
                    'value' => $element['attributes']['value'],
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
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Open Account',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'cta_lock' => $decorator->decorators[0]['attributes']['cta_lock'] ?? '',
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
            'title' => $decorator->decorators[0]['attributes']['title'],
            'badge_text' => $decorator->decorators[0]['attributes']['badge_text'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Get A Quote',
            'cta_url' => $decorator->decorators[0]['attributes']['cta_url'],
            'inactive' => $decorator->decorators[0]['attributes']['inactive'] ?? false,
            'bottom_line_title' => $decorator->decorators[0]['attributes']['bottom_line_title'],
            'bottom_line_text' => $decorator->decorators[0]['attributes']['bottom_line_text'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'review_scroll_tag' => $decorator->decorators[0]['attributes']['review_scroll_tag'] ?? null,
            'special_offer_title' => $decorator->decorators[0]['attributes']['special_offer_title'],
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
            'title' => $decorator->decorators[0]['attributes']['title'],
            'rating' => $decorator->decorators[0]['attributes']['rating'],
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Apply Now',
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
            'title' => isset($decorator->decorators[0]['attributes']['title']) ? $decorator->decorators[0]['attributes']['title'] : '',
            'name' => $decorator->decorators[0]['attributes']['name'] ?? null,
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Apply Now',
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
            'cta_text' => !empty($decorator->decorators[0]['attributes']['cta_text']) ? $decorator->decorators[0]['attributes']['cta_text'] : 'Apply Now',
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
                                'column_link' => $element['attributes']['column_link']
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
                    ->map(function($element) {
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

}
