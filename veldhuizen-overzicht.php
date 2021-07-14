<?php 
//Template name: Overzicht C2A
//Template Post Type:  page
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();

echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';
// var_dump($post->post_title);

echo '<div class="veldhuizen__container five-col">';
   if ($post->post_title === 'Producten-overzicht') {
        veldhuizen_home_c2a('trekker-oplegger', 'Producten');
        veldhuizen_home_c2a('clixtar', 'Producten');
        veldhuizen_home_c2a('aanhangwagen', 'Producten');
        veldhuizen_home_c2a('oprijvrachtwagens', 'Producten');
        veldhuizen_home_c2a('bouwvoertuigen', 'Producten');
   } else if ($post->post_title === 'Verhuur-overzicht') {
        veldhuizen_home_c2a('losse-trekkers', 'Verhuur');
        veldhuizen_home_c2a('open-opleggers', 'Verhuur');
        veldhuizen_home_c2a('gesloten-opleggers', 'Verhuur');
        veldhuizen_home_c2a('oprijvrachtwagens', 'Verhuur');
        veldhuizen_home_c2a('losse-opleggersaanhangwagens', 'Verhuur');
        veldhuizen_home_c2a('bouwvoertuigen', 'Verhuur');
   }
echo '</div>';

endwhile;
endif;
get_footer();
?>