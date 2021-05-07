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

	<footer id="colophon" class="footer">
		<div class="footer__container">
			<div class="footer__item">
				<h4>Veldhuizen B.V. Groenekan</h4>
				<p>Verkoop | Verhuur | Onderhoud</p>
				<p>Kon. Straatnaam 215</p>
				<p>1245 AS Plaats</p>
				</br>
				<p>T 2535325</p>
				<p>E adasd@asdasdas.com</p>
			</div>

			<div class="footer__item">
				<h4>Veldhuizen B.V. Zwolle</h4>
				<p>Verkoop | Verhuur | Onderhoud</p>
				<p>Kon. Straatnaam 215</p>
				<p>1245 AS Plaats</p>
				</br>
				<p>T 2535325</p>
				<p>E adasd@asdasdas.com</p>
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
				<p>Verkoop | Verhuur | Onderhoud</p>
				<p>Kon. Straatnaam 215</p>
				<p>1245 AS Plaats</p>
				</br>
				<p>T 2535325</p>
				<p>E adasd@asdasdas.com</p>
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
							'post_type' => 'Verhuur',
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
	<div class="footer__bar">
		<div class="footer__bar--container">
		<div class="footer__bar--copyright">
			<p>© Copyright - Veldhuizen <?php echo date('Y');?></p>
		</div>
		<div class="footer__bar--menu">
			<ul>
				<p>Hier komen linkjes</p>
			</ul>
		</div>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
