<?php
// Template name: Header information pages
get_header();

?>

    <?php 
    
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        if (has_post_thumbnail( $post->ID ) ) {
            $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );
            // echo '<img rel="preload" as="image" src="' . esc_attr( $attachment_image ) . '">'; 
            echo '<div class="top__banner" style="background-image: url(' . esc_attr( $attachment_image ) . ') !important;"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
        } else { 
            echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>'; 
        }
        echo '<div class="header-information-pages">';
        echo '<div class=veldhuizen__container>';
        the_content();
        echo '</div>';
        echo '</div>';
        endwhile;
        endif;
    
    ?>


<?php 
get_footer();
?>