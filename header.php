<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Veldhuizen
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'veldhuizen' ); ?></a>

	<header id="masthead" class="header">

		<div class="header__top">
			<ul>
			<li><a href="#">Rijbewijs B+E / C1+E</a></li>
			<li><a href="#">Foto's</a></li>
			<li><a href="#">Film</a></li>
			<li><a href="#">Nieuws</a></li>
			<li><a href="#">Vacatures</a></li>
			<li><a href="#">Mijn account</a></li>
			</ul>
			<a class="header__top--button" href="tel:0886259600">088 6259600</a>
		</div>

		<div class="header__container">
			<div class="header__left">
				<img src="<?php echo get_template_directory_uri();?>/content/logo-1.png" width="375px" alt="Logo Veldhuizen"/>
			</div>
			<div class="header__right">
				<ul>
					<li>
						<a href="#">Home</a>
					</li>

					<li>
						<a href="#">Producten</a>
						<ul>
							<?php
								//Args voor de producten custom post type, alleen parent pages pakken door 'post_parent' op 0 te zetten
								$args = array(
									'post_type' => 'Producten',
									'post_per_page' => 5,
									'post_parent' => 0,
									'order' => 'ASC'
								);

								$query = new WP_Query($args);
								if ($query->have_posts()) :
									while ( $query->have_posts() ) : $query->the_post();

									$img = get_the_post_thumbnail_url();
									$title = get_the_title();
									$link = get_the_permalink();

									echo "<li>
									<a href='$link'>
									<div class='header__img' style='background-image:url($img);'></div>
									$title</a>";

									//Args voor de subproducten, parent is de pagina
									$childArgs = array(
										'post_type' => 'Producten',
										'post_per_page' => -1,
										'post_parent' => $post->ID,
										'order' => 'ASC'
									);

									$childProducts = new WP_Query($childArgs);

									if ($childProducts->have_posts()) :
										echo '<div class="header__right--subitems">';
										while ($childProducts->have_posts()) : $childProducts->the_post();
											$childLink = get_the_permalink();
											$childTitle = get_the_title();
											echo "<a href='$childLink'>$childTitle</a>";
										endwhile;
										echo '</div>';
									endif;
									echo '</li>';
									endwhile;
								endif;
								$query->reset_postdata();
							?>
						</ul>
					</li>

					<li>
						<a href="#">Verhuur</a>
						<ul>
							<?php
								$verhuurArgs = array(
									'post_type' => 'Verhuur',
									'post_per_page' => 5,
									'post_parent' => 0,
								);

								$verhuurQuery = new WP_Query($verhuurArgs);
							?>
						</ul>
					</li>
					<li>
						<a href="#">Occasions</a>
					</li>
					<li>
						<a href="#">Onderdelen</a>
					</li>
					<li>
						<a href="#">Service</a>
					</li>
					<li>
						<a class="header__orange" href="#">Contact</a>
					</li>
					<li>
						<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="header__breadcrumbs">
			<p>U bevindt zich hier: <?php echo get_site_url();?>/</p>
		</div>
	</header><!-- #masthead -->
