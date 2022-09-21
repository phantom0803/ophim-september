# THEME - SEPTEMBER 2022 - OPHIM CMS

## Demo
### Trang Chủ
![Alt text](https://i.ibb.co/bWkS4Sf/September-Home-Page.png "Home Page")

### Trang Danh Sách Phim
![Alt text](https://i.ibb.co/B2dPj5S/September-Catalog-Page.png "Catalog Page")

### Trang Thông Tin Phim
![Alt text](https://i.ibb.co/6r1Z70Y/September-Single-Page.png "Single Page")

### Trang Xem Phim
![Alt text](https://i.ibb.co/Pxb8m1G/September-Episode-Page.png "Episode Page")

## Requirements
https://github.com/hacoidev/ophim-core

## Install
1. Tại thư mục của Project: `composer require ophimcms/ophim-september`
2. Cài đặt themes: `php artisan ophim:install:theme`
3. Kích hoạt giao diện trong Admin Panel

## Update
1. Tại thư mục của Project: `composer update ophimcms/ophim-september`

## Document
### List
- Trang chủ: `display_label|relation|find_by_field|value|limit|show_more_url|show_template (slider_poster|slider_thumb|section_poster|section_thumb)`
    + Ví dụ theo định dạng: `Phim bộ mới||type|series|12|/danh-sach/phim-bo|section_poster`
    + Ví dụ theo định dạng: `Phim lẻ mới||type|single|12|/danh-sach/phim-bo|section_thumb`
    + Ví dụ theo thể loại: `Phim hành động|categories|slug|hanh-dong|12|/the-loai/hanh-dong|slider_thumb`
    + Ví dụ theo quốc gia: `Phim hàn quốc|regions|slug|han-quoc|12|/quoc-gia/han-quoc|section_poster`
    + Ví dụ với các field khác: `Phim chiếu rạp||is_shown_in_theater|1|12||section_poster`

- Danh sách hot: 
    + `Phim sắp chiếu||status|trailer|publish_year|desc|9|top_text`
    + `Top phim bộ||type|series|view_total|desc|9|top_thumb`
    + `Top phim lẻ||type|single|view_total|desc|9|top_thumb`
