# Veldhuizen Wordpress theme
[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

This theme is developed in combination with a fork of Gutenberg Blocks for the website of [Veldhuizen](https://veldhuizen.nl). The code for this theme was a group effort from a team of 2:
* Andres Pinto
* Leroy Leipe gast

## Table of contents
1. Getting started
2. Custom Post Types
3. Guten Blocks
4. Folder structure
5. License


## Getting started
> ##### _S
> Hi. I'm a starter theme called `_s`, or `underscores`, if you like. I'm a theme meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.
> My ultra-minimal CSS might make me look like theme tartare but that means less stuff to get in your way when you're designing your awesome theme. Here are some of the other more interesting things you'll find here:
> * A modern workflow with a pre-made command-line interface to turn your project into a more pleasant experience.
> * A just right amount of lean, well-commented, modern, HTML5 templates.
> * A custom header implementation in `inc/custom-header.php`. Just add the code snippet found in the comments of `inc/custom-header.php` to your `header.php` template.
> * Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
> * Some small tweaks in `inc/template-functions.php` that can improve your theming experience.
> * A script at `js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in `functions.php`.
> * 2 sample layouts in `sass/layouts/` made using CSS Grid for a sidebar on either side of your content. Just uncomment the layout of your choice in `sass/style.scss`.
Note: `.no-sidebar` styles are automatically loaded.
> * Smartly organized starter CSS in `style.css` that will help you to quickly get your design off the ground.
> * Full support for `WooCommerce plugin` integration with hooks in `inc/woocommerce.php`, styling override woocommerce.css with product gallery features (zoom, swipe, lightbox) enabled.
> * Licensed under GPLv2 or later. :) Use it to make something cool.
>
>Installation
> ---------------
>
> #### Requirements
>
> `_s` requires the following dependencies:
>
> - [Node.js](https://nodejs.org/)
> - [Composer](https://getcomposer.org/)
>
> #### Quick Start
> 
> Clone or download this repository, change its name to something else (like, say, `megatherium-is-awesome`), and then you'll need to do a six-step find and replace on the name in all the templates.
> 
> 1. Search for `'_s'` (inside single quotations) to capture the text domain and replace with: `'megatherium-is-awesome'`.
> 2. Search for `_s_` to capture all the functions names and replace with: `megatherium_is_awesome_`.
> 3. Search for `Text Domain: _s` in `style.css` and replace with: `Text Domain: megatherium-is-awesome`.
> 4. Search for <code>&nbsp;_s</code> (with a space before it) to capture DocBlocks and replace with: <code>&nbsp;Megatherium_is_Awesome</code>.
> 5. Search for `_s-` to capture prefixed handles and replace with: `megatherium-is-awesome-`.
> 6. Search for `_S_` (in uppercase) to capture constants and replace with: `MEGATHERIUM_IS_AWESOME_`.
> 
> Then, update the stylesheet header in `style.css`, the links in `footer.php` with your own information and rename `_s.pot` from `languages` folder to use the theme's slug. Next, update or delete this readme.
> 
> #### Setup
> 
> To start using all the tools that come with `_s`  you need to install the necessary Node.js and Composer dependencies :
> 
> ```sh
> $ composer install
> $ npm install
> ```
> 
> ### Available CLI commands
> 
> `_s` comes packed with CLI commands tailored for WordPress theme development :
> 
> - `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
> - `composer lint:php` : checks all PHP files for syntax errors.
> - `composer make-pot` : generates a .pot file in the `languages/` directory.
> - `npm run compile:css` : compiles SASS files to css.
> - `npm run compile:rtl` : generates an RTL stylesheet.
> - `npm run watch` : watches all SASS files and recompiles them to css when they change.
> - `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
> - `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
> - `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.
> 
> Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme. :)
> 
> Good luck!

## Functions.php
### Custom post types
```php
// REGISTERING CUSTOM POST TYPES
function veldhuizen_post_type() {
    $labels = array(
        'name'                  => _x( 'Producten', 'Post type general name', 'product' ),
        (...)
    );     
    $args = array(...);
      
    register_post_type( 'Producten', $args );
}

function veldhuizen_verhuur_post_type() {
    $labels = array(
        'name'                  => _x( 'Verhuur', 'Post type general name', 'verhuur product' ),
        (...)
    );     
    $args = array(...);
      
    register_post_type( 'Verhuur', $args );
}
```

### Important functions
#### Registering GB templates
```php
//  REGISTERING TEMPLATES FOR CUSTOM POST TYPE 'producten' 
// Reference to custom guten blocks
function veldhuizen_products_register_template() {
    $post_type_object = get_post_type_object( 'producten' );
    $post_type_object->template = array(
		array('cgb/veldhuizen-banner'),
		array('cgb/block-veldhuizen-container-block')
	);
}
//  REGISTERING TEMPLATES FOR CUSTOM POST TYPE 'verhuur' 
function veldhuizen_verhuur_register_template() {
	$verhuur_object = get_post_type_object('verhuur');
	$verhuur_object->template = array(
		array('cgb/veldhuizen-banner'),
		array('cgb/block-veldhuizen-verhuur-container')
	);
}
```
#### Custom functions for content
```php
// CUSTOM FUNCTIONS 

// CallToAction elements on the home page -> veldhuizen-home.php
function veldhuizen_home_c2a($c2a) {
	$types = array( 'Producten', 'Verhuur', 'page', 'post' );
	$page = get_page_by_path($c2a, $output, $types);
	$image = get_the_post_thumbnail_url($page->ID);
	$title = ($page->post_title);
	$link = get_the_permalink($page->ID);
	echo '<a class="block " href="' . $link . '" >';
	echo '<img src="'. $image . '"/>';
	echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
	echo '<h5>' . $title . '</h5>';
    echo '</div>';
	echo '</a>';
}

// Vacancy listing element on the home page -> veldhuizen-home.php
function veldhuizen_home_vacatures() {
	echo  '<h3>Vacatures</h3>';
	echo '<p>Veldhuizen b.v. is fabrikant van aanhangwagens en opleggers voor BE-rijbewijs. Onze productrange bestaat verder uit oprij vrachtwagens en diverse Hovertrack varianten. Om aan de groeiende vraag uit de markt te voldoen, zijn wij op zoek naar:</p>';
	$vacature_page = get_page_by_path('vacatures');
	
	$vacatures = get_children($vacature_page->ID);
	echo '<ul>';
	foreach($vacatures as $child) {
		$vacatureTitle = get_the_title ( $child->ID );
		$vacatureLink = get_the_permalink( $child->ID );
		echo '<a href="' . $vacatureLink . '">';
		echo '<li>' . $vacatureTitle . '</li>';
		echo '</a>';
	}
	echo '</ul>';
}

// News listing element on the home page -> veldhuizen-home.php
function veldhuizen_home_news() {
	echo  '<h3>Nieuws</h3>';
	$args = array(
        'post_type'     => 'post',
        'post_status'   => 'published',
        'category_name' => 'nieuws',
        (...)
    );
	$news = get_posts($args);
	
	echo '<div class="articles-wrapper">';
	foreach($news as $newsArticle) {
		$removeTags = array('<br>', '<br><br>', '<br />', '<br/>', '<br   >');
		$thumb = get_the_post_thumbnail_url($newsArticle);
        $parsedContent = parse_blocks($newsArticle->post_content);
		$link = get_the_permalink($newsArticle);
		$excerptRaw = $parsedContent[2]['attrs']['content'];
		$excerptRaw = substr($excerptRaw, 0, 300);
		$excerptClean = strip_tags($excerptRaw, $removeTags);

        echo '<a class="article-links" href="' . $link . '" />';
        echo '<article class="news-article">';
        echo '<img src="' . $thumb . '" alt="Afbeelding van ' . ($newsArticle->post_name) . '" />';
        echo '<div class="article-text-wrapper">';
        echo '<h4>' . ($newsArticle->post_title) . '</h4>';
        echo '<p class="article-excerpt">' . $excerptClean . '...</p>';
        echo '</div>';
        echo '</article>';
		echo '<button>Lees meer</button>';
        echo '</a>';
    }
	echo '</div>';
}
```

#### WCF7 remove `<br>`
```php 
add_filter('wpcf7_autop_or_not', '__return_false'); // Remove all BR's and P in Contact Form 7 
```

### Server Templates
#### Dynamic templates
* `content-none.php` serves displays 404
* `content-page.php` fallback template
* `content-producten.php` serves template for overview products & product detail pages || `post_type => 'producten'`
* `content-search.php` serves default search template
* `content-service.php` serves template for service page and children
* `content-verhuur.php` serves template for overview verhuur & verhuur detail pages || `post_type => 'verhuur'`
* `content.php` serves default/fallback template for `post_type => 'post'`

### Static pages
* `veldhuizen-contact.php` serves template for contact page
* `veldhuizen-header-info.php` serves template for all the static pages on the `header__top`, above the `nav`
* `veldhuizen-info.php` serves template for information pages like `privacyverklaring` & `cookiebeleid`
* `veldhuizen-nieuws.php` serves template for news overview page 
* `veldhuizen-occassion.php` serves template for occassion page with `iframe`
* `veldhuizen-product.php` test template for products
* `veldhuizen-service.php` serves template for `service` page and children

### Styling
Most of the folders speak for themselves. All changes and exceptions are done in `sass/layouts`. GB custom block styling is done in the corresponding plugin folder. 

### Javascript
#### `excerptCutter.js`
 looks at the window size and cuts the amount of characters of the news excerpts based on it.
Used in `home/nieuws` 

#### `galleryBehavior.js`
Script for modal used in `product/detail`, `verhuur/detail` and `home/fotos`. Also changes the image used in the print layout on `beforeprint`, so it's always the first shown image. With `afterprint` change the shown image back to where the user was. 

#### `iframeLazy.js`
This poorly named file is a script for a Youtube modal. Used exclusively in `home/film`.

#### `productEuro.js`
This is practically a regex. Used exclusively in `product/detail`. This script cleans up a lot of garbage elements in the descriptions of the products and some breaks so the content is aligned they way the client wants. This instead of cleaning the actual content. 

#### `verhuurTable.js`
Forces the table used in `verhuur/detail` to have the same width. The tables used for the descriptions, most of the time, don't have the same amount of rows. This script forces column positioning, so the tables always line up. 