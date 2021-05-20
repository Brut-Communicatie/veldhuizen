<?php
//Template name: Veldhuizen informatie
//Template Post Type: page
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

echo '<div class="information-pages">';
echo '<h1>';
the_title();
echo '</h1>';
the_content();
echo '</div>';

endwhile;
endif;

get_footer();?>