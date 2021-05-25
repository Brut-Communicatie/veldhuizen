<?php
//Template name: Veldhuizen iFrame
//Template Post Type: page
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile;
endif;
?>
<div id="svm-canvas"></div>
<script type="text/javascript">
(function(){h=document.getElementsByTagName('head')[0];s=document.createElement('script');
s.type='text/javascript';s.src="https://voorraad.veldhuizen.nl/js/svm.js?t="+Date.now();s.onload=function(){
vm=svm.create('3ea1','https://voorraad.veldhuizen.nl/',true, {'carousel': false, 'carouselOptions': {'direction': false, 'amount': false}, 'quick_search': true}, 'quick_search');
vm.init();};h.appendChild(s);})();
</script>
<?php
get_footer();?>