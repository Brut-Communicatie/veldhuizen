<?php
//Template name: Veldhuizen iFrame
//Template Post Type: page
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile;
endif;
?>

<iframe id="voorraadFrame" src="https://voorraad.veldhuizen.nl/" width="100%"></iframe>
<?php
get_footer();?>