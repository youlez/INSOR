<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_StyleSheets_Action")) {
    /**
     * Class WD_ASL_StyleSheets_Action
     *
     * Handles the non-ajax searches if activated.
     *
     * @class         WD_ASL_StyleSheets_Action
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Actions
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_StyleSheets_Action extends WD_ASL_Action_Abstract {

        /**
         * Holds the inline CSS
         *
         * @var string
         */
        private static $inline_css = "";

        /**
         * This function is bound as the handler
         */
        public function handle( ) {
			global $pagenow;

            $exit1 = apply_filters('asl_load_css_js', false);
            $exit2 = apply_filters('asl_load_css', false);
            if ($exit1 || $exit2)
                return false;

            // Don't print if on the back-end
            if ( !is_admin() || $pagenow === 'widgets.php' ) {
	            $styles = (new WD_ASL_Styles())->get();

	            add_action('wp_head', function() use($styles) {
		            if ($styles['inline'] != "") {
			            ?>
			            <style>
				            <?php
				            // prevent any XSS
				            echo str_replace(array('</style', '</', '<'), '',$styles['inline']);
							?>
			            </style>
			            <?php
		            }
	            }, 10, 0);
				foreach ( $styles['src'] as $name => $style ) {
					wp_enqueue_style("wpdreams-asl-$name", $style, array(), ASL_CURR_VER_STRING);
				}
            }

            return true;
        }

        /**
         * Echos the inline CSS if available
         */
        public function inlineCSS() {

        }

        // ------------------------------------------------------------
        //   ---------------- SINGLETON SPECIFIC --------------------
        // ------------------------------------------------------------
        /**
         * Static instance storage
         *
         * @var self
         */
        protected static $_instance;

        public static function getInstance() {
            if ( ! ( self::$_instance instanceof self ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
    }
}