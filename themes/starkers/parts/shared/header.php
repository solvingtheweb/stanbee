<div id="container">
<header>
	
	<?php //list pages exluding home 
		wp_page_menu('exclude=5&sort_column=menu_order'); ?>
	<div id="header_middle">
		<div id="recycle">
			<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_recycle.png">
		</div>
	</div>
	<a href="<?php bloginfo('url');?>" rel="Stanbee"><img src="<?php bloginfo( 'template_url' ); ?>/images/stanbee_logo.png" id="header_logo"></a>
	
</header>
<br class="clear" />
