<?php 
	$stella_theme_options = stella_get_theme_options();
	$has_vertical_menu = in_array($stella_theme_options['ts_header_layout'], array('v1','v4')); 
?>
</div><!-- #main .wrapper -->
	<?php if( !is_page_template('page-templates/blank-page-template.php') && $stella_theme_options['ts_footer_block'] ): ?>
	<footer id="colophon" class="footer-container footer-area loading">
		<?php stella_get_footer_content( $stella_theme_options['ts_footer_block'] ); ?>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

	<?php if( $has_vertical_menu ): ?>
		<div id="vertical-menu-sidebar" class="vertical-menu-sidebar hidden-phone">
			<div class="overlay"></div>
			<div class="ts-sidebar-content">
				<span class="close"></span>
				<div class="vertical-menu-wrapper">
					<?php
						if( has_nav_menu( 'vertical' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu', 'theme_location' => 'vertical', 'walker' => new stella_Walker_Nav_Menu() ) );
						}elseif( has_nav_menu( 'primary' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu', 'theme_location' => 'primary', 'walker' => new stella_Walker_Nav_Menu() ) );
						}
						else{
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu' ) );
						}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
		
	<!-- Group Header Button -->
	<div id="group-icon-header" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content <?php echo esc_attr( ( $stella_theme_options['ts_header_layout'] == 'v4' && has_nav_menu( 'vertical' ) ) ? '' : 'no-tab' ); ?>">
		
			<div class="sidebar-content">
				<?php 
					$logo_mobile_menu = is_array($stella_theme_options['ts_logo_menu_mobile'])?$stella_theme_options['ts_logo_menu_mobile']['url']:$stella_theme_options['ts_logo_menu_mobile'];
					$logo_text = $stella_theme_options['ts_text_logo'] ? $stella_theme_options['ts_text_logo'] : get_bloginfo('name');
					
					if( !$logo_mobile_menu ){
						$logo_mobile_menu = is_array($stella_theme_options['ts_logo'])?$stella_theme_options['ts_logo']['url']:$stella_theme_options['ts_logo'];
					}
					if( $logo_mobile_menu ){
				?>
				<div class="logo-wrapper">
					<div class="logo">
						<a href="<?php echo esc_url( home_url('/') ); ?>">
							<img src="<?php echo esc_url($logo_mobile_menu); ?>" loading="lazy" alt="<?php echo esc_attr($logo_text); ?>" class="menu-mobile-logo" />
						</a>
					</div>
				</div>
				<?php } ?>
				
				<ul class="tab-mobile-menu">
					<li id="main-menu" class="active"><span><?php esc_html_e('Menu', 'stella'); ?></span></li>
					<?php if( $has_vertical_menu && has_nav_menu( 'vertical' ) ): ?>
						<li id="vertical-menu"><span><?php esc_html_e('Categories', 'stella'); ?></span></li>
					<?php endif; ?>
				</ul>
				
				<h6 class="menu-title"><span><?php esc_html_e('Menu', 'stella'); ?></span></h6>
				
				<div class="mobile-menu-wrapper ts-menu tab-menu-mobile">
					<div class="menu-main-mobile">
						<?php 
						if( has_nav_menu( 'mobile' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile', 'walker' => new stella_Walker_Nav_Menu() ) );
						}else{
							if( $has_vertical_menu && has_nav_menu( 'vertical' ) ){
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu', 'theme_location' => 'vertical', 'walker' => new stella_Walker_Nav_Menu() ) );
							}else{
								if( has_nav_menu( 'primary' ) ){
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new stella_Walker_Nav_Menu() ) );
								}else{
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
								}
							}
						}
						?>
					</div>
				</div>
				
				<?php if( $stella_theme_options['ts_header_layout'] == 'v4' ): ?>
					<div class="mobile-menu-wrapper ts-menu tab-vertical-menu">
						<div class="vertical-menu-wrapper">			
							<?php
								if( has_nav_menu( 'primary' ) ){
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new stella_Walker_Nav_Menu() ) );
								}else{
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
								}
							?>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="group-button-header">
					<?php if( $stella_theme_options['ts_enable_tiny_account'] || $stella_theme_options['ts_header_currency'] || $stella_theme_options['ts_header_language'] ): ?>
					<div class="meta-bottom">
					
						<?php if( $stella_theme_options['ts_header_layout'] != 'v5' && ( $stella_theme_options['ts_header_currency'] || $stella_theme_options['ts_header_language'] ) ): ?>
						<div class="language-currency">
							
							<?php if( $stella_theme_options['ts_header_language'] ): ?>
							<div class="header-language"><?php stella_wpml_language_selector(); ?></div>
							<?php endif; ?>
							
							<?php if( $stella_theme_options['ts_header_currency'] ): ?>
							<div class="header-currency"><?php stella_woocommerce_multilingual_currency_switcher(); ?></div>
							<?php endif; ?>
							
						</div>
						<?php endif; ?>
						
						<?php if( $stella_theme_options['ts_enable_tiny_account'] ): ?>
						<div class="my-account-wrapper">
							<?php echo stella_tiny_account(false); ?>
						</div>	
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
				</div>
				
			</div>	
		</div>
	</div>
		
<?php endif; ?>

<!-- Search Sidebar -->
<?php if( $stella_theme_options['ts_enable_search'] ): ?>
	
	<div id="ts-search-sidebar" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content">
			<div class="ts-search-by-category woocommerce">
				<div class="search--header">
					<h2 class="title"><?php esc_html_e('Search for products', 'stella'); ?> (<span class="count">0</span>)</h2>
					<span class="close"></span>
				</div>
				
				<div class="search--form">
					<?php get_search_form(); ?>
				</div>
				
				<div class="ts-search-result-container"></div>
			</div>
		</div>
	</div>

<?php endif; ?>

<!-- Shopping Cart Floating Sidebar -->
<?php if( class_exists('WooCommerce') && $stella_theme_options['ts_enable_tiny_shopping_cart'] && $stella_theme_options['ts_shopping_cart_sidebar'] && !is_cart() && !is_checkout() ): ?>
<div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
	<div class="overlay"></div>
	<div class="ts-sidebar-content">
		<span class="close"></span>
		<div class="ts-tiny-cart-wrapper"></div>
	</div>
</div>
<?php endif; ?>

<?php 
if( ( !wp_is_mobile() && $stella_theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $stella_theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	
<a class="scroll-button" href="#" onclick="window.scrollTo(0, 0);"><?php esc_html_e('Back to Top', 'stella'); ?></a>
</div>
<?php endif; ?>

<?php 
wp_footer(); ?>
</body>
</html>