<?php

namespace Ophim\September;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class SeptemberServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/september')
        ], 'september-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'september' => [
                'name' => 'September',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/ophim-september',
                'publishes' => ['september-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommendations Limit',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 10,
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (slider_poster|slider_thumb|section_poster|section_thumb)',
                        'value' => "Phim bộ mới||type|series|12|/danh-sach/phim-bo|section_thumb\r\nPhim lẻ mới||type|single|12|/danh-sach/phim-bo|section_poster\r\nPhim lẻ mới||type|single|10|/danh-sach/phim-bo|slider_thumb\r\nPhim lẻ mới||type|single|10|/danh-sach/phim-bo|slider_poster",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_text|top_thumb)',
                        'value' => "Top phim lẻ||type|single|view_total|desc|9|top_text\r\nTop phim bộ||type|single|view_total|desc|9|top_thumb",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "class='bg-main-900 text-gray-300 font-montserrat leading-normal tracking-normal'",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div class="w-full mx-auto flex flex-wrap">
                            <div class="flex w-full lg:w-3/5">
                                <div class="px-2">
                                    <span class="font-bold text-gray-100">Giới Thiệu</span>
                                    <p class="text-gray-300 text-sm pt-3">
                                        <b>OPHIMCMS</b> - Website xem phim online miễn phí.
                                    </p>
                                    <p class="text-gray-300 text-sm">Với giao diện trực quan, thuận tiện, tốc độ tải nhanh, ít quảng cáo
                                        hứa
                                        hẹn sẽ đem lại những trải nghiệm tốt cho người xem.</p>
                                </div>
                            </div>
                            <div class="flex w-1/3 lg:w-1/5">
                                <div class="px-2">
                                    <span class="font-bold text-gray-100">Kết Nối</span>
                                    <ul class="list-reset items-center text-sm pt-3">
                                        <li>
                                            <a class="inline-block text-gray-50 no-underline hover:text-main-primary hover:text-underline py-1"
                                                href="#">
                                                FanPage
                                            </a>
                                        </li>
                                        <li>
                                            <a class="inline-block text-gray-50 no-underline hover:text-main-primary hover:text-underline py-1"
                                                href="#">
                                                Group
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex w-2/3 lg:w-1/5">
                                <div class="px-2">
                                    <span class="font-bold text-gray-100">Liên hệ</span>
                                    <ul class="list-reset items-center text-sm pt-3">
                                        <li class="text-gray-300">email@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
