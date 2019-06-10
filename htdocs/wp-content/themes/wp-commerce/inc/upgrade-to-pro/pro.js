/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="wp-commerce-ads"> <a href="https://wpfactory.com/item/wp-commerce-theme-for-woocommerce/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',wp_commerce_customizer_js_obj.pro));
});