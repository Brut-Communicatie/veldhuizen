<?php
//Template name: Veldhuizen home

get_header();

// LETS SEEEEEEEEEEEEEEEEEEEEEEEEEEE

if ( have_posts() ) : while ( have_posts() ) : the_post();




echo '<div id="home-container">';
the_content();
// var_dump( get_page_by_path('home/producten-overzicht') );
echo '<div class="veldhuizen__container">';
// veldhuizen_home_c2a('home/producten-overzicht');
// veldhuizen_home_c2a('home/verhuur-overzicht');
veldhuizen_home_c2a('occassions');
veldhuizen_home_c2a('onderdelen');
veldhuizen_home_c2a('service');
echo '</div>';

echo '<div class="home-vacatures">';
veldhuizen_home_vacatures();
echo '</div>';

echo '<div class="home-news">';
echo '<a class="footer-links" href="'. get_the_permalink(  ) .'">&lt;</a>';
echo '<a class="footer-links" href="'. get_the_permalink(  ) .'">&gt;</a>';
veldhuizen_home_news();
echo '</div>';

echo '</div>';



endwhile;
endif;
get_footer();?>


    