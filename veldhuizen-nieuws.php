<?php
//Template name: Veldhuizen Nieuws
//Template Post Type: page, post
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
$post_type = get_post_type();
// var_dump($post_type);

echo '<div class="top__banner"><div class="top__content"><h1>'. $post->post_title  .'</h1></div></div>';

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
        $removeTags = array('<br>', '<br><br>', '<br />', '<br/>', '<br   >');
		$thumb = get_the_post_thumbnail_url($newsArticle);
        $parsedContent = parse_blocks($newsArticle->post_content);
		$link = get_the_permalink($newsArticle);
		$excerptRaw = $parsedContent[2]['attrs']['content'];
		$excerptRaw = substr($excerptRaw, 0, 350);
		$excerptClean = strip_tags($excerptRaw, $removeTags);
    
        echo '<a class="article-links" href="' . $link . '" />';
        echo '<article class="news-article">';
        echo '<img src="' . $thumb . '" alt="Afbeelding van ' . ($newsArticle->post_name) . '" />';
        echo '<div class="article-text-wrapper">';
        echo '<h2>' . ($newsArticle->post_title) . '</h2>';
        echo '<p>' . $excerptClean . '...</p>';
        echo '</div>';
        echo '</article>';
        echo '</a>';
    }
    echo '</div>';
} else if ($post_type == 'post') {
    // var_dump(the_content());
    echo '<div class="news-article-page" >';
    echo '<div class="veldhuizen__container">';
    the_content();
    echo '</div>';
    echo '</div>';
}



endwhile;
endif;

get_footer();?>