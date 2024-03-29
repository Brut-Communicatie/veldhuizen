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

$notification = new CouponNotification;
$notification = $notification->setCustomAccountNotification();
echo $notification;

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
			<ul class="no-print">
			<li><a href="<?php echo get_page_link( get_page_by_path( 'rijbewijs-be' )); ?>">Rijbewijs B+E / C1+E</a></li>
			<li><a href="<?php echo get_page_link( get_page_by_path( 'fotos' )); ?>">Foto's</a></li>
			<li><a href="<?php echo get_page_link( get_page_by_path( 'film' )); ?>">Film</a></li>
			<li><a href="<?php echo get_page_link( get_page_by_path( 'nieuws' )); ?>">Nieuws</a></li>
			<li><a href="<?php echo get_page_link( get_page_by_path( 'vacatures' )); ?>">Vacatures</a></li>
			<li><a href="#">Mijn account</a></li>
			</ul>
			<a class="header__top--button no-print" href="tel:0886259600"><img src="<?php echo get_template_directory_uri();?>/content/icons/phone.svg" width="12px" alt="Home icoon"/> 088 6259600</a>
		</div>

		<div class="header__container">
			<div class="header__left">
				<a href="<?php echo get_home_url(); ?>">
				<img src="<?php echo get_template_directory_uri();?>/content/logo-1.png" width="375px" id="logo-print" alt="Logo Veldhuizen"/>
				</a>
			</div>
			<div id="hamburger" class="header__right--menu no-print">
					<img src="<?php echo get_template_directory_uri();?>/content/icons/bars.svg" width="25px" alt="Home icoon"/> 
			</div>
			<div id="header-menu" class="header__right no-print">

						<p id="close-menu" class="header__mobile">Sluit menu</p>
		
				<ul>
				
					<li>
						<a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/content/icons/home.svg" width="25px" alt="Home icoon"/></a>
					</li>

					<li>
						<!-- <a id="productenLink" href="#">Producten</a> -->
					<a id="productenLink" href="<?php echo get_page_link(get_page_by_path('producten-overzicht')); ?>">Producten</a>
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
						<a id="verhuurLink" href="<?php echo get_page_link(get_page_by_path('verhuur-overzicht')); ?>">Verhuur</a>
						<ul>
						<?php
								$verhuurArgs = array(
									'post_type' => 'Verhuur',
									'post_per_page' => 5,
									'post_parent' => 0,
									'order' => 'ASC'
								);

								$verhuurQuery = new WP_Query($verhuurArgs);
								
								if ($verhuurQuery->have_posts()) :
									while ( $verhuurQuery-> have_posts() ) : $verhuurQuery->the_post();
									$verhuurImg = get_the_post_thumbnail_url();
									$verhuurTitle = get_the_title();
									$verhuurLink = get_the_permalink();

									echo "<li class='nav-verhuur'>
									<a href='$verhuurLink'>
									<div class='header__img' style='background-image:url($verhuurImg);'></div>
									$verhuurTitle</a>";

									//Args voor de subproducten, parent is de pagina
									$childArgs = array(
										'post_type' => 'Verhuur',
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
								$verhuurQuery->reset_postdata();
							?>
						</ul>
					</li>
					<li>
						<a href="<?php echo get_page_link( get_page_by_path( 'occassions' ) ); ?>">Occasions</a>
					</li>
					<li>
						<a href="<?php echo get_page_link( get_page_by_path( 'onderdelen' ) ); ?>">Onderdelen</a>
						<ul>
							<?php 
								$onderdelen = wc_get_products(array(
									'category' => array('onderdelen'),
								));

								if (isset($onderdelen)) {
									foreach ($onderdelen as $onderdeel) {
										$prod_title = $onderdeel->name;
										$prod_image = wp_get_attachment_url($onderdeel->get_image_id());
										$prod_link = $onderdeel->get_permalink();
										echo '<li class="nav-shop">';
										echo '<a href="' . $prod_link . '">';
										echo '<div class="header__img" style="background-image:url(' . $prod_image . ')";></div>';
										echo $prod_title . '</a>';
										echo '</li>';
									}
								}
							?>
						</ul>
					</li>
					<li>
						<a href="<?php echo get_page_link( get_page_by_path( 'service' ) ); ?>">Service</a>
						<ul id="service-anchors">
						<?php
						$homeUrl = get_home_url();
							echo '<li><a href="'. $homeUrl .'/service#onderhoudsgegevens">Onderhoudsgegevens</a></li>';
							echo '<li><a href="'. $homeUrl .'/service#aan-af-koppelen">Aan/afkoppelen clixtar</a></li>';
							echo '<li><a href="'. $homeUrl .'/service#reparatieformulier-service">Reparatieformulier</a></li>';
						?>
						</ul>
					</li>
					<li>
						<a class="header__orange" href="<?php echo get_page_link( get_page_by_path( 'contact' ) ); ?>">Contact</a>
					</li>
					<li>
						<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
							<div class="cart__total--icon">
								<img src="<?php echo get_template_directory_uri();?>/content/icons/shopping-cart-solid.svg" width="20px" alt="Shopping cart icoon"/>
								<span class="header__orange cart__total--span">
									<?php echo WC()->cart->get_cart_contents_count() ?>
								<span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="header__breadcrumbs no-print">
			<?php
				global $wp_query;
				$postTitle = get_the_title($wp_query->post->ID);
				$postType = get_post_type($wp_query->post->ID);
				$parentPost = get_post_parent($wp_query->post->ID);
				$categoryName = get_the_category($wp_query->post->ID);
				$category1 = ($categoryName[0]->category_nicename);
				$category2 = ($categoryName[1]->category_nicename);
				
				if (is_front_page()){
					echo '<p>U bevindt zich hier: ' . $postTitle .'</p>';
				} else if ($postType === 'page') {
					if (isset($parentPost)) {
						echo '<p>U bevindt zich hier: ' . ucfirst($parentPost->post_name) . ' / ' . $postTitle .'</p>';
					} else  {
						echo '<p>U bevindt zich hier: ' . $postTitle .'</p>';
					}
				} else if ($postType === 'post' and ($categoryName[0]->category_nicename) == 'nieuws') {
					echo '<p>U bevindt zich hier: Nieuws / ' . $postTitle .'</p>';
				} else if ($postType === 'producten' or $postType === 'verhuur') {
					if (empty($category2) === false && empty($category1) === false ) {
						$megaParent = get_post_parent($parentPost->ID);
						echo '<p>U bevindt zich hier: ' . ucfirst($postType) . ' / ' . ucfirst($megaParent->post_title) . ' / ' . ucfirst($parentPost->post_title)  . ' / ' . $postTitle .'</p>';
					} else if (empty($category2) === true and empty($category1) === false){
						echo '<p>U bevindt zich hier: ' . ucfirst($postType) . ' / ' . ucfirst($categoryName[0]->category_nicename) . ' / ' . $postTitle .'</p>';
					} else {
						echo '<p>U bevindt zich hier: ' . ucfirst($postType) . ' / ' . $postTitle .'</p>';
					}
				} else if ($postType === 'product') {
					if (is_shop()) {
						echo '<p>U bevindt zich hier: Onderdelen</p>';
					} else {
						echo '<p>U bevindt zich hier: Onderdelen / ' . $postTitle .'</p>';
					}
				}
			?>
		</div>
	</header><!-- #masthead -->
