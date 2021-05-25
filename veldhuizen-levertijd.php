<?php
// Template name: Voorraad
get_header();?>




    <?php 
    
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
        echo '<div class="voorraad">';
        // echo '<div class="veldhuizen__container">';
        the_content();
        // echo '</div>';
        echo '</div>';
        endwhile;
        endif;
    
    ?>


<?php 
wp_enqueue_script( 'veldhuizen-voorraad', get_template_directory_uri() . '/js/voorraad.js', false, false );
get_footer();
?>