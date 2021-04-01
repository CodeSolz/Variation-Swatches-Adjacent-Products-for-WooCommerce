<?php

/**
 * Check Dependencies
 *
 * @package Install
 * @since 1.0.0
 * @author M.Tuhin <info@codesolz.com>
 */

if ( ! defined( 'CS_WVSAP_VERSION' ) ) {
	exit;
}

if ( ! function_exists( 'CsWvsapCheckDependencies' ) ) {

	function CsWvsapCheckDependencies() {

		// trigger notice
		add_action(
			'admin_notices',
			function() {
				?>
				<div class="notice cs-notice notice-error" >
					<p>
						<strong><?php echo CS_WVSAP_PLUGIN_NAME; ?></strong>
					</p>
					<p>
					<?php
						echo sprintf(
							__(
								'In order to activate and use %2$s%1$s%3$s at first you need to keep installed & activate any one of the following plugins <br><br>'
								. '1. %4$sVariation Swatches for WooCommerce%5$s - %7$s Emran Ahmed %8$s <br>'
								. '2. %6$sVariation Swatches for WooCommerce%5$s - %7$s ThemeAlien %8$s',
								'better-find-and-replace-pro'
							),
							CS_WVSAP_PLUGIN_NAME,
							'<code>',
							'</code>',
							'<a href="https://wordpress.org/plugins/woo-variation-swatches/" target="_blank">',
							'</a>',
							'<a href="https://wordpress.org/plugins/variation-swatches-for-woocommerce/" target="_blank">',
							'<b><i>', 
							'</i></b>'
						);
					?>
					</p>

				</div>
				<?php
			}
		);

		return false;
	}
}


if ( function_exists( 'add_action' ) ) {
	add_action(
		'admin_init',
		function() {
			if( false === CsWvsapHasDependencies() ){	
				CsWvsapCheckDependencies();
			}
		}
	);

}


if ( ! function_exists( 'CsWvsapHasDependencies' ) ) {

	function CsWvsapHasDependencies() {

		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		if ( is_plugin_active( 'woo-variation-swatches/woo-variation-swatches.php' ) ||
			is_plugin_active( 'variation-swatches-for-woocommerce/variation-swatches-for-woocommerce.php' )
		) {
			return true;
		}

		return false;
	}
}

