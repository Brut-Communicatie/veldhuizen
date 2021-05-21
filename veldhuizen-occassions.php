<?php 
//Template name: Occassions pagina
//Template Post Type:  page
get_header();
?>

<?php 
echo '<div class="occassion-iframe-wrapper">';
echo '<iframe src="https://voorraad.veldhuizen.nl/" width="100%" height="12775" style="height: 12775px;"></iframe>'; 
echo '</div>';
?>
    
<?php 
    wp_enqueue_script( 'veldhuizen-occassion-iframe', get_template_directory_uri() . '/js/iframeCleanup.js', false, false );
    get_footer();
?>