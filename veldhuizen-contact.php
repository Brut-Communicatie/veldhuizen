<?php
//Template name: Veldhuizen Contact
//Template Post Type: page
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); 
echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
echo '<iframe src="https://www.google.com/maps/d/embed?mid=1XdRdVIOV-_crTh9H9_flts_8_mQ" width="100%" height="400"></iframe>';
echo '<div class=veldhuizen-contact>';
echo '<div class=veldhuizen__container>';
the_content();
echo '</div>';
echo '</div>';

echo '<div class="service-pages">';
echo '<div class="reparatie-formulier">';
echo '<h2>Contactformulier</h2>';
echo '<div class="veldhuizen__container">';
// echo do_shortcode('[contact-form-7 id="19040" title="Reparatieformulier"]');
echo do_shortcode('[contact-form-7 id="1718" title="Contactformulier"]');
echo '</div>';
echo '</div>'; 
echo '</div>'; 

endwhile;
endif;
get_footer();
?>

