<?php
//Template name: Veldhuizen iFrame
//Template Post Type: page
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile;
endif;
?>

<iframe id="voorraadFrame" src="https://voorraad.veldhuizen.nl/" width="100%" height="1000px"></iframe>
<?php
get_footer();?>