<?php
// get_header();


global $post;

$args = array('post_parent'    => get_the_ID(),
'order'          =>  'ASC',
'post_type'      => 'verhuur',
);

$hasChildren = get_children($args);

if (!$hasChildren) {
    the_content();
}


else {
    echo '<div class="top__banner"><div class="top__content"><h1>Verhuur '. $post->post_title  .'</h1></div></div>';
    echo '<div class="veldhuizen__container--intro verhuur-lorem">';
	echo '<h2 class="verhuur-lorem">' . $post->post_title  . '</h2>';
	echo '<p class="verhuur-lorem">' . 'Hier is de mogelijkheid om een klein stukje tekst toe te voegen' . '</p>';
	echo '</div>';
	echo '<div class="veldhuizen__container">';
    foreach($hasChildren as $child){

        $childImage = get_the_post_thumbnail_url( $child->ID);
        $childTitle = get_the_title( $child->ID );
        $childLink = get_the_permalink( $child->ID );

        echo '<a class="block" href="'. $childLink .'">';
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
