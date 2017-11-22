<?php
/**
 * Form class
 * @author Flipper Code<hello@flippercode.com>
 * @version 3.0.0
 * @package Image Hover Effects Pro
 */

if ( ! class_exists( 'WOP_FORM' ) ) {

	class WOP_FORM extends FlipperCode_HTML_Markup{

		function __construct($options = array()) {
			
			$premium_features = "<ul class='fc-pro-features'>
			<li>Apply Hover Effect Post Type Wise - On Featured Image Of Any Post Type</li>
			<li>Apply Hover Effect Category Wise</li>
			<li>Apply Specific Hover Effect For Particular Post/Page/CPT's featured image</li>
			<li>Apply Hover Effects On Custom Images When Building Page Content With Visual Composer</li>
			<li>Apply Hover Effects On Custom Images Using Shortcodes</li>
			<li>Display Hover Effects On Woocommerce Product Image On Shop Page</li>
			<li>New Woocommerce Related Placeholders For Displaying Product Related Information On Overlays</li>
			<li><a href='https://www.flippercode.com/image-hover-effects-pro/' target='_blank'>Stunning Gradient Effects</a> & Many More New Effects Included In Effects Gallery & Many <a href='https://codecanyon.net/item/wp-image-hover-effects-pro/19228283' target='_blank'>More</a> </li>
			</ul>";
			
			$productInfo = array('productName' => __('WP Overlays',WOP_TEXT_DOMAIN),
					'productSlug' => 'image-hover-effects-pro',
					'productTagLine' => 'WP Pverlays - a plugin that automatically adds beatiful image hover effects over blog posts featured images and on custom images',
					'productTextDomain' => WOP_TEXT_DOMAIN,
					'productIconImage' => WOP_URL.'core/core-assets/images/wp-poet.png',
					'productVersion' => WOP_VERSION,
					'videoURL' => 'https://www.youtube.com/watch?v=-TA4tEde0Wk&list=PLlCp-8jiD3p2L9CvY7xMa1rqcQCD3lV6U',
					'docURL' => 'http://imagehover.flippercode.com/',
					'demoURL' => 'http://imagehover.flippercode.com/',
					'productImagePath' => WOP_URL.'core/core-assets/product-images/',
					'productSaleURL' => 'https://codecanyon.net/item/wp-image-hover-effects-pro/19228283',
					'multisiteLicence' => 'https://codecanyon.net/item/wp-image-hover-effects-pro/19228283',
					'premium_features' => $premium_features,
			);
    
			$productInfo = array_merge($productInfo, $options);
			parent::__construct($productInfo);

		}

	}
	
}
