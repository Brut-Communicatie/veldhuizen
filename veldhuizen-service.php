<?php
//Template name: Veldhuizen Service Pagina's
//Template Post Type: page
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
global $post;
// var_dump($post);
$postTitle = $post->post_name;

if ($postTitle == 'aankoppelen-clixtar') {
    get_template_part('content/service/page' , 'trekker');
} else {
the_content();


echo '<main id="primary" class="site-main">';
echo '<div class="service-pages">';

echo '<div class="onderhoud-wrapper">';
echo '<h2>' . 'Onderhoudsgegevens' . '</h2>';
echo '<div class="veldhuizen__container">';
    // VERLICHTING SCHEMA
    echo '<a class="block" href="https://veldhuizen.nl/wp-content/uploads/verlichting_schema-2017.pdf?iframe=true">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-achterlicht.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'Verlichting schema';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 

    // APK AFSTELINSTRUCTIE HYDROSTOPP
    echo '<a class="block" href="https://veldhuizen.nl/wp-content/uploads/afstelinstructie_hydrostop_APK.pdf?iframe=true">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-assen.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'A.P.K. afstelinstructie Hydro-Stopp® Remsysteem';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 

    // ABS STORINGSCODES
    echo '<a class="block" href="https://veldhuizen.nl/wp-content/uploads/ABS-Storingscodes-GRAU-Haldex.pdf?iframe=true">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-remklauw.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'GRAU/Haldex ABS storingscodes';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 

    // REMBLOKKEN
    echo '<a class="block" href="https://veldhuizen.nl/wp-content/uploads/2014-10-09-remvoeringlijst.pdf?iframe=true">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-remblokken.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'Remblokken';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 
echo '</div>';
echo '</div>';

echo '<div class="koppelen-clixtar">';
echo '<h2>Aan/afkoppelen van Clixtar oplegger</h2>';
echo '<div class="veldhuizen__container">';

    // AANKOPELLEN CLIXTAR BLOCK
    echo '<a class="block" href="http://veldhuizen.local/service/aankoppelen-clixtar/">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-clixtar-koppelen.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'Aankoppelen Clixtar';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 

    // AFKOPELLEN CLIXTAR BLOCK
    echo '<a class="block" href="http://veldhuizen.local/service/afkoppelen-clixtar/">';
    echo '<img src="https://veldhuizen.nl/wp-content/uploads/service-clixtar-los.png" alt="Afbeelding van het achterlicht van een voertuig" />';
    echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
    echo '<h5>';
    echo 'Afkopellen Clixtar';
    echo '</h5>';
    echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
    echo '</a>'; 

echo '</div>';      // CLOSE VELDHUIZEN__CONTAINER DIV
echo '</div>';      // CLOSE KOPPELEN-CLIXTAR DIV

echo '<div class="reparatie-formulier">';
echo '<h2>Reparatieformulier</h2>';
echo '<div class="veldhuizen__container">';
// echo do_shortcode('[contact-form-7 id="19040" title="Reparatieformulier"]');
echo do_shortcode('[contact-form-7 id="1284" title="Reparatieformulier"]');
echo '</div>';
echo '</div>';       // CLOSE REPARATIE-FORMULIER DIV


echo '</div>';
echo '</main>';

}
endwhile;
endif;
get_footer();?>
