<?php
//Template name: Veldhuizen Nieuws
//Template Post Type: page, post
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
$post_type = get_post_type();
// var_dump($post_type);

if ($post_type == 'page') {
    $args = array(
        'post_type'     => 'post',
        'post_status'   => 'published',
        'category_name' => 'nieuws',
        'orderby'       => 'date',
        'order'         => 'DESC'
    );
    $news = get_posts($args);
    // var_dump($news);
    
    echo '<div class="news">';
    foreach($news as $newsArticle) {
        $thumb = get_the_post_thumbnail_url($newsArticle);
        $excerpt = get_the_excerpt($newsArticle);
        $link = get_the_permalink($newsArticle);
    
        echo '<a href="' . $link . '" />';
        echo '<article class="news-article">';
        echo '<h2>';
        echo ($newsArticle->post_name);
        echo '</h2>';
        echo '<img src="' . $thumb . '" alt="Afbeelding van ' . ($newsArticle->post_name) . '" />';
        echo '<p>' . $excerpt . '</p>';
        echo '</article>';
        echo '</a>';
    }
    echo '</div>';
} else if ($post_type == 'post') {
    the_content();
}



endwhile;
endif;

get_footer();?>