<?php
//Template name: Veldhuizen home

get_header();

// LETS SEEEEEEEEEEEEEEEEEEEEEEEEEEE

if ( have_posts() ) : while ( have_posts() ) : the_post();




echo '<div id="home-container">';
the_content();

$producten = 'Producten';
veldhuizen_home_c2a('vacatures');
veldhuizen_home_c2a('producten');
// var_dump(get_page_by_path('producten', $output, $producten));



// if ($query->have_posts()) :
//     echo '<div class="veldhuizen__container">';
//     while ( $query-> have_posts() ) : $query->the_post();
    
//         $img = get_the_post_thumbnail_url();
//         $title = get_the_title();
//         $link = get_the_permalink();

//         echo '<a class="block" href="'. $link.'">';
//         echo '<div class="block__info">';
//         echo '<div class="block__square"></div>';
//         echo '<h5>' . $title . '</h5>';
//         echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
//         echo '</div>';
//         echo '</a>';
//     endwhile;
//     echo '</div>';
// endif;

echo '</div>';

endwhile;
endif;

// echo '<div class="banner-home-page">';
// echo '<img id="banner-home-page" src="https://veldhuizen.testjevorm.nl/wp-content/uploads/home-page.jpeg">';
// echo '<div class="veldhuizen__container">';
// echo '<h1>Veldhuizen</h2>';
// echo '<h3>Voor de juiste transport oplossing</h3>';
// echo '<p>Veldhuizen B.V. is gespecialiseerd in diepladers voor transport tot 27 ton </p>';
// echo '<p>Wij bieden u een gevarieerd en uitgebreid pakket in koop en verhuur van aanhangwagens, opleggers en oprijwagens. Met een ervaren en enthousiast team van 60 medewerkers helpen wij u bij het vinden van de juiste oplossing.</p>';
// echo '<p>Ook voor service en onderhoud kunt u bij ons terecht</p>';
// echo '<p>In onze webshop vindt u alle onderdelen die wij op voorraad hebben.</p>';
// echo '</div>';
// echo '</div>';

get_footer();?>