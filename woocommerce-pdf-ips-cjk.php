<?php
/**
 * Plugin Name:      PDF Invoices & Packing Slips for WooCommerce - mPDF CJK
 * Requires Plugins: woocommerce-pdf-ips-mpdf
 * Plugin URI:       https://github.com/wpovernight/woocommerce-pdf-ips-mpdf-cjk
 * Description:      Chinese, Japanese, and Korean font pack for the mPDF extension.
 * Version:          1.0.0
 * Author:           WP Overnight
 * Author URI:       https://wpovernight.com
 * License:          GPLv3
 * License URI:      https://opensource.org/licenses/gpl-license.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function wpo_ips_mpdf_cjk_load_fonts_dir( $mpdf ) {
	if ( ! $mpdf instanceof \Mpdf\Mpdf || ! method_exists( $mpdf, 'AddFontDirectory' ) ) {
		wcpdf_log_error( 'wpo_ips_mpdf_cjk_load_fonts_dir: mPDF not found or AddFontDirectory method not available' );
		return $mpdf;
	}
	
	$mpdf->AddFontDirectory( __DIR__ . '/fonts' );
	$mpdf->autoScriptToLang = true;
	$mpdf->autoLangToFont   = true;
	
	// Ensures mPDF marks all non-Latin text with lang attributes.
	// This helps apply the correct font to CJK characters while ignoring regular Latin text.
	$mpdf->baseScript = 1;

	return $mpdf;
}

add_filter( 'wpo_wcpdf_before_mpdf_write', 'wpo_ips_mpdf_cjk_load_fonts_dir' );
