<?php if (!defined('ABSPATH')) {
	exit; // Exit if directly accessed
}
/**
 * Fired during plugin activation
 */
if (!class_exists('WordReplacerUltra')) {
	class WordReplacerUltra {
		public function __construct() {
			/*Menu hook*/
			add_action('admin_menu', array($this, 'register_word_replacer_ultra_menu'));
			/*Register Styling Scripts*/
			add_action('admin_enqueue_scripts', array($this, 'word_replacer_ulta_script_styles'));

		}

		public function register_word_replacer_ultra_menu() {
			if (is_admin()) {
				add_menu_page('Word Replacer', 'Word Replacer', 'edit_pages', 'word-replacer-ultra', array($this, 'word_replacer_ultra_settings'), 'dashicons-search', 30);
			}

		}
		public function word_replacer_ulta_script_styles($hook) {
			if ($hook != 'toplevel_page_word-replacer-ultra') {
				return;
			}

			wp_enqueue_style('custom-css', WORD_REPLACER_ULTRA_URL . '/assets/css/custom.css');
			wp_enqueue_script('jquery-validate', WORD_REPLACER_ULTRA_URL . '/assets/js/jquery-validate.js', '', '', true);
			wp_enqueue_script('main-script', WORD_REPLACER_ULTRA_URL . '/assets/js/main-script.js', array('jquery'), '5.5.3', true);
			wp_localize_script('main-script', 'object',
				array(
					'ajax_url' => admin_url('admin-ajax.php'),
				)
			);
		}

		public function word_replacer_ultra_settings() {

			if (is_admin() && current_user_can('manage_options')) {
				require WORD_REPLACER_ULTRA_PATH . '/templates/settings.php';
			} else {
				_e('Denied ! Only admin can see this.', 'word-replacer-ultra');
			}

		}
		public function word_replacer_ultra_validator($field) {
			if (empty($field)) {
				return;
			}
			$field = sanitize_text_field($field);
			$field = trim($field);
			$field = stripslashes($field);
			$field = htmlspecialchars($field);
			return $field;
		}
	}
	new WordReplacerUltra();
}
