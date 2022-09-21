# THEME - SEPTEMBER 2022 - OPHIM CMS

## Demo
### Home Page
![Alt text](./demo/September-HomePage.png?raw=true "Home Page")

### Catalog Page
![Alt text](./demo/September-CatalogPage.png?raw=true "Catalog Page")

### Single Page
![Alt text](./demo/September-SinglePage.png?raw=true "Single Page")

### Episode Page
![Alt text](./demo/September-EpisodePage.png?raw=true "Episode Page")

## Requirements
https://github.com/hacoidev/ophim-core
## Install
1. CD to project root and run: `composer require ophimcms/ophim-september`
2. run: `php artisan ophim:install:theme`
3. Active themes in Admin Panel

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
