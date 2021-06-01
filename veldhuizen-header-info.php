<?php
// Template name: Header information pages
get_header();

?>

    <?php 

        // global $post;
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
            $args = array('post_parent'    => get_the_ID(),
            'order'          =>  'ASC',
            'post_type'      => 'page',
            );
            $hasChildren = get_children($args);
        endwhile;
        endif;
        // RUN PAGES WITH NO CHILDREN, LOOKS LIKE A USUAL CONTENT PAGE
        if (!$hasChildren){
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            // If parent is 'Vacatures' a top banner without images is used
            $parentID = $post->post_parent;
            $parent = get_post($parentID);
            // if(($parent->post_name) == 'vacatures' ) { 
            //     echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
            //     echo '<div class="header-information-pages">';
            //     echo '<div class="veldhuizen__container">';
            //     the_content();
            //     echo '</div>';
            //     echo '</div>';
            // }

            if(($parent->post_name) == 'films' ) { 
                echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
                echo '<div class="header-information-pages">';
                echo '<div class="film-container-wrapper">';
                echo '<div class="veldhuizen__container">';
                the_content();
                echo '</div>';
                echo '</div>';
                echo '</div>';
                wp_enqueue_script( 'veldhuizen-lazy-loading', get_template_directory_uri() . '/js/iframeLazy.js', false, false );
            }
            else {
                // If available, put the image in the backgroud of the top banner
                if (has_post_thumbnail( $post->ID ) ) {
                    $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );
                    $parentID = $post->post_parent;
                    $parent = get_post($parentID);
                    if(($parent->post_name) == 'rijbewijs-be' ) {
                        echo '<div class="top__banner" style="background-image: url(' . esc_attr( $attachment_image ) . ') !important;"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
                    }
                    else {
                        echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>'; 
                    }
                } else { 
                    echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>'; 
                }
                echo '<div class="header-information-pages">';
                echo '<div class="veldhuizen__container">';
                the_content();
                echo '</div>';
                echo '</div>';
            }
        endwhile;
    endif;
        } 

        // IF CHILDREN, THEN OVERVIEW PAGE WITH CHILDREN
        else {
            // header pagina
            echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
            echo '<div class="veldhuizen__container--intro">';
            echo '<h2>' . $post->post_content  . '</h2>';
            // echo '<h2>' . wp_strip_all_tags(the_content())  . '</h2>';
            echo '</div>';
            
            echo '<div class="veldhuizen__container">';
            foreach($hasChildren as $child){
                $childImage = get_the_post_thumbnail_url( $child->ID);
                $childTitle = get_the_title( $child->ID );
                $childLink = get_the_permalink( $child->ID );
                $childTag = get_the_tags($child->ID);
               
                echo '<a class="block '. $childClass .'" href="'. $childLink .'">';
                echo '<img src="'. $childImage .'" alt="Afbeelding van '. $childTitle .'" />';
                echo '<div class="block__info">';
                echo '<div class="block__square"></div>';
                echo '<h5>';
                echo $childTitle;
                echo '</h5>';
                echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
                echo '</div>';
                echo '</a>'; 
            }
            echo '</div>';
        }
    ?>

<?php 
get_footer();
?>