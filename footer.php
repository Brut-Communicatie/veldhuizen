<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Veldhuizen
 */

?>

	<footer id="colophon" class="footer no-print">
		<div class="footer__container">
			<div class="footer__item">
				<h4>Veldhuizen B.V. Groenekan</h4>
				<p>Verkoop | Verhuur | Onderhoud</p>
				<p>Kon. Wilhelminaweg 259</p>
				<p>3737 BA Groenekan</p>
				</br>
				<p><strong>T</strong> <a href="tel:+31886259600"> +31(0)88 6259600</a></p>
				<p><strong>E</strong> <a href="mailto:info@veldhuizen.nl">info@veldhuizen.nl</a></p>
			</div>

			<div class="footer__item">
				<h4>Veldhuizen B.V. Zwolle</h4>
				<p>Steunpunt Hoverstracks en BE-opleggers</p>
				<p>Hermelenweg 158</p>
				<p>8028 PL Zwolle</p>
				</br>
				<p><strong>T</strong> <a href="tel:+310886259670"> +31(0)88 6259670</a></p>
			</div>
			<div class="footer__item">
				<h4>Producten</h4>
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

							$title = get_the_title();
							$link = get_the_permalink();

							echo "<li>
							<a href='$link'>
							$title</a>";

							echo '</li>';
							endwhile;
						endif;
						$query->reset_postdata();
					?>
				</ul>
			</div>

			<div class="footer__item">
				<h4>Veldhuizen B.V. Loosdrecht</h4>
				<p>Productie</p>
				<p>Nieuw Loosdrechtsedijk 40</p>
				<p>1231 KZ Loosdrecht</p>
				</br>
				<p><strong>T</strong> <a href="tel:+310886259600"> +31(0)88 6259600</a></p>
			</div>
			<div class="footer__item">
				<h4>Onderdelen</h4>
			</div>
			<div class="footer__item">
				<h4>Verhuur</h4>
				<ul>
					<?php
						//Args voor de producten custom post type, alleen parent pages pakken door 'post_parent' op 0 te zetten
						$args = array(
							'post_type' => 'verhuur',
							'post_per_page' => 5,
							'post_parent' => 0,
							'order' => 'ASC'
						);

						$query = new WP_Query($args);
						if ($query->have_posts()) :
							while ( $query->have_posts() ) : $query->the_post();

							$title = get_the_title();
							$link = get_the_permalink();

							echo "<li>
							<a href='$link'>
							$title</a>";

							echo '</li>';
							endwhile;
						endif;
						$query->reset_postdata();
					?>
				</ul>
			</div>
		</div>
	</footer><!-- #colophon -->
	<div class="footer__bar no-print">
		<div class="footer__bar--container">
		<div class="footer__bar--copyright">
			<p>© Copyright - Veldhuizen <?php echo date('Y');?></p>
		</div>
		<div class="footer__bar--menu">
			<ul>
				<li><a href="https://hovertrack.nl/">Hovertrack</a></li>
				<li><a href="https://www.google.com/maps/d/viewer?ll=52.395715%2C5.671692000000007&spn=0.670393%2C1.507874&t=m&msa=0&z=9&source=embed&ie=UTF8&mid=1XdRdVIOV-_crTh9H9_flts_8_mQ">Route</a></li>
				<li><a href="http://veldhuizen.testjevorm.nl/wp-content/uploads/2021/05/algemene_verhuurvoorwaarden_.pdf?iframe=true">Leveringsvoorwaarden</a></li>
				<li><a href="https://veldhuizen.testjevorm.nl/wp-content/uploads/metaalunievoorwaarden-2019-nederlands.pdf">Algemene voorwaarden</a></li>
				<li><a href="<?php echo get_page_link( get_page_by_path( 'privacyverklaring' ) ); ?>">Privacyverklaring</a></li>
				<li><a href="<?php echo get_page_link( get_page_by_path( 'cookiebeleid' ) ); ?>">Cookiebeleid</a></li>
			</ul>
		</div>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
