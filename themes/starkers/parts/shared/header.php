<div id="container">
<header>
	
	<?php //list pages exluding home 
	wp_page_menu('exclude=5'); ?>
	<a href="<?php bloginfo('url');?>" rel="Stanbee"><img src="<?php bloginfo( 'template_url' ); ?>/images/stanbee_logo.png" id="header_logo"></a>
	
</header>
